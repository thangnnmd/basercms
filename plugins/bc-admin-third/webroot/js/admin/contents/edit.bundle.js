!function(e){var t={};function n(i){if(t[i])return t[i].exports;var r=t[i]={i:i,l:!1,exports:{}};return e[i].call(r.exports,r,r.exports,n),r.l=!0,r.exports}n.m=e,n.c=t,n.d=function(e,t,i){n.o(e,t)||Object.defineProperty(e,t,{enumerable:!0,get:i})},n.r=function(e){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(e,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(e,"__esModule",{value:!0})},n.t=function(e,t){if(1&t&&(e=n(e)),8&t)return e;if(4&t&&"object"==typeof e&&e&&e.__esModule)return e;var i=Object.create(null);if(n.r(i),Object.defineProperty(i,"default",{enumerable:!0,value:e}),2&t&&"string"!=typeof e)for(var r in e)n.d(i,r,function(t){return e[t]}.bind(null,r));return i},n.n=function(e){var t=e&&e.__esModule?function(){return e.default}:function(){return e};return n.d(t,"a",t),t},n.o=function(e,t){return Object.prototype.hasOwnProperty.call(e,t)},n.p="",n(n.s=16)}({16:function(e,t){
/**
 * baserCMS :  Based Website Development Project <https://basercms.net>
 * Copyright (c) baserCMS Users Community <https://basercms.net/community/>
 *
 * @copyright       Copyright (c) baserCMS Users Community
 * @link            https://basercms.net baserCMS Project
 * @since           baserCMS v 4.0.0
 * @license         https://basercms.net/license/index.html
 */
$((function(){window.setTimeout((function(){window.scrollTo(0,1)}),100);var e=$("#AdminContentsEditScript").attr("data-fullurl"),t=$("#AdminContentsEditScript").attr("data-previewurl"),n=$.parseJSON($("#AdminContentsEditScript").attr("data-current")),i=$.parseJSON($("#AdminContentsEditScript").attr("data-settings"));$("form #ContentsFormTabs").tabs().show(),$("#BtnSave").click((function(){$.bcUtil.showLoader()})),$("#BtnPreview").click((function(){window.open("","preview");var n=$(this).parents("form"),i=n.attr("action"),r="default",o=t;return $("#ContentAliasId").val()&&(r="alias"),"draft"==$("#DraftModeContentsTmp").val()&&(r="draft"),o.match(/\?/)?o+="&url="+e+"&preview="+r:o+="?url="+e+"&preview="+r,n.attr("target","preview"),n.attr("action",o),n.submit(),n.attr("target","_self"),n.attr("action",i),$.get("/baser/baser-core/bc_form/get_token?requestview=false",(function(e){$('input[name="_csrfToken"]').val(e)})),!1})),$("#BtnDelete").click((function(){var e=bcI18n.contentsEditConfirmMessage1;if($("#ContentAliasId").val()&&(e=bcI18n.contentsEditConfirmMessage2),confirm(e)){$("#BtnDelete").prop("disabled",!0),$.bcUtil.showLoader();var t=$(this).parents("form");t.attr("action",$.bcUtil.adminBaseUrl+"baser-core/contents/delete"),t.submit()}return!1})),$(".create-alias").click((function(){var e=$(this).attr("data-site-id"),t=$("#site-display-name"+e).val(),r=$("#site-target-url"+e).val(),o={content:{title:n.name,plugin:n.plugin,type:n.type,site_id:e,alias_id:n.id,entity_id:n.entity_id,url:n.url}};return confirm(bcI18n.contentsEditConfirmMessage3.sprintf(t))&&$.bcToken.check((function(){return $.ajax({url:$.bcUtil.apiBaseUrl+"baser-core/contents/is_unique_content",headers:{Authorization:$.bcJwt.accessToken},type:"POST",data:{url:r,_csrfToken:$.bcToken.key},beforeSend:function(){$.bcUtil.showLoader()},success:function(e){e?($.bcToken.key=null,$.bcToken.check((function(){return $.ajax({url:i[n.type].url.add,headers:{Authorization:$.bcJwt.accessToken},type:"POST",data:$.extend(o,{_csrfToken:$.bcToken.key}),dataType:"json",beforeSend:function(){$("#Waiting").show()},success:function(e){$.bcUtil.showNoticeMessage(bcI18n.contentsEditInfoMessage1),$.bcUtil.showNoticeMessage(e.message),location.href=$.bcUtil.adminBaseUrl+"baser-core/contents/edit_alias/"+e.content.id},error:function(e,t,n){$.bcUtil.hideLoader(),$.bcUtil.showAlertMessage(bcI18n.contentsEditAlertMessage1),$.bcToken.key=null}})}),{useUpdate:!1,hideLoader:!1})):($.bcUtil.hideLoader(),$.bcUtil.showAlertMessage(bcI18n.contentsEditAlertMessage2))},error:function(e,t,n){$.bcUtil.hideLoader(),$.bcUtil.showAlertMessage(bcI18n.contentsEditAlertMessage1)}})}),{useUpdate:!1,hideLoader:!1}),!1})),$(".create-copy").click((function(){var e=$(this).attr("data-site-id"),t=$("#site-display-name"+e).val(),r=$("#site-target-url"+e).val(),o={title:n.title,siteId:e,parentId:n.parent_id,contentId:n.id,entityId:n.entity_id,url:n.url};return confirm(bcI18n.contentsEditConfirmMessage4.sprintf(t))&&$.bcToken.check((function(){return $.ajax({url:$.bcUtil.apiBaseUrl+"baser-core/contents/is_unique_content",headers:{Authorization:$.bcJwt.accessToken},type:"POST",data:{url:r,_csrfToken:$.bcToken.key},beforeSend:function(){$.bcUtil.showLoader()},success:function(e){e?($.bcToken.key=null,$.bcToken.check((function(){return $.ajax({url:i[n.type].url.copy,headers:{Authorization:$.bcJwt.accessToken},type:"POST",data:$.extend(o,{_csrfToken:$.bcToken.key}),dataType:"json",beforeSend:function(){$("#Waiting").show()},success:function(e){$.bcUtil.showNoticeMessage(bcI18n.contentsEditInfoMessage2),location.href=i[n.type].url.edit+"/"+e.entity_id},error:function(e,t,n){$.bcUtil.hideLoader(),$.bcToken.key=null,$.bcUtil.showAlertMessage(bcI18n.contentsEditAlertMessage4)}})}),{useUpdate:!1,hideLoader:!1})):($.bcUtil.hideLoader(),$.bcUtil.showAlertMessage(bcI18n.contentsEditAlertMessage3))},error:function(e,t,n){$.bcUtil.hideLoader(),$.bcUtil.showAlertMessage(bcI18n.contentsEditAlertMessage4)}})}),{useUpdate:!1,hideLoader:!1}),!1})),$("#ContentModifiedDate").val()||($("#ContentModifiedDateDate").val(getNowDate()),$("#ContentModifiedDateTime").val(getNowTime()))}))}});
//# sourceMappingURL=edit.bundle.js.map