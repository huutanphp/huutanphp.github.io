/*
	Hex search with nibble-level wildcards, like “?3 37 13 ?7”
	Useful in locating ARM instruction using search instead of offset, which would change in every version upgrade. ARM instruction pattern is relatively more stable.
	This hex seach script also covers UTF-8 Text search features.
	
	Please preserve this note, if you are gonna reuse and share with others
	Contribute by Happy Secret on iOSGods (2023)
*/


h5gg.require(7.9);
var h5frida = h5gg.loadPlugin("h5frida", "h5frida-16.0.10.dylib");
if (!h5frida) throw "Failed to load h5frida plugin";
if (!h5frida.loadGadget("frida-gadget-16.0.10.dylib"))
   throw "Failed to load frida-gadget daemon module";
var frontapp = h5frida.get_frontmost_application();
if (!frontapp) throw "frida can't get frontapp";
var session = h5frida.attach(frontapp.pid);
if (!session) throw "frida attach process failed";
session.on("detached", function (reason) {
   alert("Hack is gone, please restart game to turn back on!");
});
var frida_script_line = frida_script("getline"); //safari console will auto add 2 line
var frida_script_code = "(" + frida_script.toString() + ")()"; //convert frida script to string
var script = session.create_script(frida_script_code); //inject frida script
if (!script) throw "frida inject script failed!";
script.on('message', function (msg) {
   if (msg.type == 'error') {
      script.unload(); // stop frida script if there are error 
      try {
         if (msg.fileName == "/frida_script.js") msg.lineNumber += frida_script_line - 1;
      } catch (e) {}
      if (Array.isArray(msg.info)) msg.info.map(function (item) {
         try {
            if (item.fileName == "/frida_script.js")
               item.lineNumber += frida_script_line - 1;
         } catch (e) {};
         return item;
      });
      var errmsg = JSON.stringify(msg, null, 1).replace(/\/frida_script\.js\:(\d+)/gm,
         function (m, c, o, a) {
            return "/frida_script.js:" + (Number(c) + frida_script_line - 1);
         });
      alert("frida script error:\n" + errmsg.replaceAll("\\n", "\n"));
   }
   if (msg.type == 'send')
      recv_frida_data(msg.payload);
   if (msg.type == 'log')
      alert("HACK log:\n" + msg.payload);
});
if (!script.load()) throw "frida load script failed"; //initiate script 
function recv_frida_data(payload) {
   if (payload.type == "debug")
      gDebug.push(payload.data);
   /* DebugMode: Use below line instead*/
   //alert("frida error:\n"+JSON.stringify(payload.data,null,1).replaceAll("\\n","\n")); TURN ON FOR DEBUG MODE
}
/**********************************************************************************/

/***************************************************************/
/*
下面是frida的js脚本代码, 运行在目标进程, 不能在h5gg中直接调用这个js函数
frida的js脚本代码中不能使用任何h5gg的函数和变量, 也不能使用window对象
h5gg和frida只能通过console.log和send/recv/post还有rpc.exports进行通信
The following is the js script code of frida, which runs in the target process, and this js function cannot be called directly in h5gg
You cannot use any h5gg functions and variables in frida's js script code, nor can you use the window object
h5gg and frida can only communicate through console.log and send/recv/post and rpc.exports
*/
function frida_script() {
   if (arguments.length) return new Error().line; //do not modify this line!!!

   function searchText(sText) {
      let pattern = utf8ToleHex(sText);

      searchHex(pattern, sText);
   }

   function searchHex(pattern, sText) {
      try {
         let ms = [];
         if (sText) {
            ms = Process.enumerateRanges('rw-');
         } else {
            ms = Process.enumerateModules();
         }

         let m;
         let results;
         let currentrec = 0;
         for (let i = 0; i < ms.length; i++) {
            m = ms[i];

            try {
               results = Memory.scanSync(m.base, m.size, pattern);
            } catch (e) {};
            if (results.length > 0) {
               for (let j = 0; j < results.length && j < 100; j++) {
                  currentrec++;
                  if (sText)
                     debugInfo("Search text: " + sText + " with pattern: " + pattern + ", result (" + currentrec + ")", [results[j].address]);
                  else
                     debugInfo("Search pattern: " + pattern + ", result (" + currentrec + ")", [results[j].address]);
               }
            }

         }

         if (currentrec == 0) {
            console.log("not found (" + pattern + ")");
            return false;
         } else console.log("Search (" + pattern + ")found: " + currentrec + " results");


      } catch (e) {
         console.log(e);
      }

   }

   global.getByteString = function (byteAry) {
      let uintary = new Uint8Array(byteAry);
      let byteStr = "";
      let tmp = "";
      for (let i = 0; i < uintary.length; i++) {
         if (Number(uintary[i]) < 16) tmp = "0" + uintary[i].toString(16)
         else tmp = uintary[i].toString(16);
         byteStr = byteStr + " " + tmp;
      }
      return byteStr;
   }
   global.debugInfo = function (message, objects, size) {
      //send({type:"debug", data:{text:"Tapping into creature and status obj", address:[creature,status], objData:[creatureData,statusData]}});
      let objMemData = [];
      let byteAry;
      if (!size) size = 0x200;
      for (let i = 0; i < objects.length; i++) {
         byteAry = objects[i].readByteArray(size);
         objMemData.push(getByteString(byteAry));
      }
      send({
         type: "debug",
         data: {
            text: message,
            address: objects,
            objData: objMemData
         }
      });
   }
   global.getVirualAddr = function (addr) {
      let ms = Process.enumerateModules();
      let m;
      for (let i = 0; i < ms.length; i++) {
         if (ms[i].name == 'UnityFramework') {
            m = ms[i];
            break;
         }
      }
      return new NativePointer(Number(m.base) + Number(addr));
   }
   //convert little Endian hex to UTF-8 
   function hexToUtf8(hex) {
      hex = bigLittleHex(hex);
      let bytes = Uint8Array.from(hex.match(/.{1,2}/g), byte => parseInt(byte, 16));
      let decoder = new TextDecoder('utf-8');
      let str = decoder.decode(bytes);
      return str;
   }

   //convert UTF-8 to little Endian hex
   function utf8ToleHex(str) {
      let hex = '';
      for (let i = 0; i < str.length; i++) {
         let code = str.charCodeAt(i);
         let bytes = [];

         if (code <= 0x7f) {
            bytes.push(code);
         } else if (code <= 0x7ff) {
            bytes.push(((code >> 6) & 0x1f) | 0xc0);
            bytes.push((code & 0x3f) | 0x80);
         } else if (code <= 0xffff) {
            bytes.push(((code >> 12) & 0x0f) | 0xe0);
            bytes.push(((code >> 6) & 0x3f) | 0x80);
            bytes.push((code & 0x3f) | 0x80);
         } else if (code <= 0x10ffff) {
            bytes.push(((code >> 18) & 0x07) | 0xf0);
            bytes.push(((code >> 12) & 0x3f) | 0x80);
            bytes.push(((code >> 6) & 0x3f) | 0x80);
            bytes.push((code & 0x3f) | 0x80);
         }

         for (let j = 0; j < bytes.length; j++) {
            let byteHex = bytes[j].toString(16);
            if (byteHex.length === 1) {
               byteHex = '0' + byteHex;
            }
            hex += byteHex;
         }
      }
      //return bigLittleHex(hex);
      return hex;
   }

   //Switch Hex before Little and Big Endian
   function bigLittleHex(hex) {
      let hex2 = '';
      for (let i = hex.length - 2; i >= 0; i -= 2) {
         hex2 += hex.substring(i, i + 2);
      }
      return hex2;
   }

   //Make hex more readable by added alternative space character
   function formatHex(hex) {
      let tmp = '';
      if (hex) {
         for (let i = 0; i < hex.length; i += 2) {
            tmp = tmp + ' ' + hex.substring(i, i + 2);
         }
      }
      return tmp;
   }

   searchText('Quick Options');
   searchText('Shortsword');
   searchHex('020080d2??????94680640f9141540f900f200?0');

}