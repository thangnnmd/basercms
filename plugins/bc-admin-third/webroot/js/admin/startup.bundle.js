!function(e){var t={};function n(o){if(t[o])return t[o].exports;var r=t[o]={i:o,l:!1,exports:{}};return e[o].call(r.exports,r,r.exports,n),r.l=!0,r.exports}n.m=e,n.c=t,n.d=function(e,t,o){n.o(e,t)||Object.defineProperty(e,t,{enumerable:!0,get:o})},n.r=function(e){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(e,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(e,"__esModule",{value:!0})},n.t=function(e,t){if(1&t&&(e=n(e)),8&t)return e;if(4&t&&"object"==typeof e&&e&&e.__esModule)return e;var o=Object.create(null);if(n.r(o),Object.defineProperty(o,"default",{enumerable:!0,value:e}),2&t&&"string"!=typeof e)for(var r in e)n.d(o,r,function(t){return e[t]}.bind(null,r));return o},n.n=function(e){var t=e&&e.__esModule?function(){return e.default}:function(){return e};return n.d(t,"a",t),t},n.o=function(e,t){return Object.prototype.hasOwnProperty.call(e,t)},n.p="",n(n.s=11)}({11:function(e,t){
/**
 * baserCMS :  Based Website Development Project <https://basercms.net>
 * Copyright (c) baserCMS User Community <https://basercms.net/community/>
 *
 * @copyright     Copyright (c) baserCMS User Community
 * @link          https://basercms.net baserCMS Project
 * @since         5.0.0
 * @license       http://basercms.net/license/index.html MIT License
 */
$((function(){$(".help").bt&&($(".helptext").css("display","none"),$.bt.options.closeWhenOthersOpen=!0,$(".help").bt({trigger:"click",positions:"top",shadow:!0,shadowOffsetX:1,shadowOffsetY:1,shadowBlur:8,shadowColor:"rgba(101,101,101,.6)",shadowOverlap:!1,noShadowOpts:{strokeStyle:"#999",strokeWidth:1},width:"600px",spikeLength:12,spikeGirth:18,padding:20,cornerRadius:0,strokeWidth:1,strokeStyle:"#656565",fill:"rgba(255, 255, 255, 1.00)",cssStyles:{fontSize:"14px"},showTip:function(e){$(e).fadeIn(200)},hideTip:function(e,t){$(e).animate({opacity:0},100,t)},contentSelector:"$(this).next('.helptext').html()"})),$("#BtnMenuHelp").click((function(){"none"===$("#Help").css("display")?$("#Help").fadeIn(300):$("#Help").fadeOut(300)})),$("#CloseHelp").click((function(){$("#Help").fadeOut(300)})),$.bcUtil.init([])}))}});
//# sourceMappingURL=startup.bundle.js.map