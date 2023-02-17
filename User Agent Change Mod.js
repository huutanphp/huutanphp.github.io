// ==UserScript==
// @name        Change navigator.userAgent
// @namespace   Rob W
// @description Changes navigator.userAgent to IE on IEGallery.com
// @match       http://www.iegallery.com/*
// @match       http://my-user-agent.com/*
// @run-at      document-start
// @grant       none
// @version     1
// ==/UserScript==

Object.defineProperty(navigator, 'userAgent', {
    value: 'Mozilla/5.0 (compatible; MSIE 10.0; Windows NT 6.2; Trident/6.0)'
});