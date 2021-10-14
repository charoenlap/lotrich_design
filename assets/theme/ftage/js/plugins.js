// Avoid `console` errors in browsers that lack a console.
(function() {
    var method;
    var noop = function () {};
    var methods = [
        'assert', 'clear', 'count', 'debug', 'dir', 'dirxml', 'error',
        'exception', 'group', 'groupCollapsed', 'groupEnd', 'info', 'log',
        'markTimeline', 'profile', 'profileEnd', 'table', 'time', 'timeEnd',
        'timeline', 'timelineEnd', 'timeStamp', 'trace', 'warn'
    ];
    var length = methods.length;
    var console = (window.console = window.console || {});

    while (length--) {
        method = methods[length];

        // Only stub undefined methods.
        if (!console[method]) {
            console[method] = noop;
        }
    }
}());



/*!
* jQuery meanMenu v2.0.8
* @Copyright (C) 2012-2014 Chris Wharton @ MeanThemes (https://github.com/meanthemes/meanMenu)
*
*/
/*
* This program is free software: you can redistribute it and/or modify
* it under the terms of the GNU General Public License as published by
* the Free Software Foundation, either version 3 of the License, or
* (at your option) any later version.
*
* THIS SOFTWARE AND DOCUMENTATION IS PROVIDED "AS IS," AND COPYRIGHT
* HOLDERS MAKE NO REPRESENTATIONS OR WARRANTIES, EXPRESS OR IMPLIED,
* INCLUDING BUT NOT LIMITED TO, WARRANTIES OF MERCHANTABILITY OR
* FITNESS FOR ANY PARTICULAR PURPOSE OR THAT THE USE OF THE SOFTWARE
* OR DOCUMENTATION WILL NOT INFRINGE ANY THIRD PARTY PATENTS,
* COPYRIGHTS, TRADEMARKS OR OTHER RIGHTS.COPYRIGHT HOLDERS WILL NOT
* BE LIABLE FOR ANY DIRECT, INDIRECT, SPECIAL OR CONSEQUENTIAL
* DAMAGES ARISING OUT OF ANY USE OF THE SOFTWARE OR DOCUMENTATION.
*
* You should have received a copy of the GNU General Public License
* along with this program. If not, see <http://gnu.org/licenses/>.
*
* Find more information at http://www.meanthemes.com/plugins/meanmenu/
*
*/
(function ($) {
	"use strict";
		$.fn.meanmenu = function (options) {
				var defaults = {
						meanMenuTarget: jQuery(this), // Target the current HTML markup you wish to replace
						meanMenuContainer: '.mobile-menu-area .container', // Choose where meanmenu will be placed within the HTML
						meanMenuClose: "X", // single character you want to represent the close menu button
						meanMenuCloseSize: "18px", // set font size of close button
						meanMenuOpen: ["<span />", "<span />", "<span />"], // text/markup you want when menu is closed
						meanRevealPosition: "right", // left right or center positions
						meanRevealPositionDistance: "0", // Tweak the position of the menu
						meanRevealColour: "", // override CSS colours for the reveal background
						meanScreenWidth: "991", // set the screen width you want meanmenu to kick in at
						meanNavPush: "", // set a height here in px, em or % if you want to budge your layout now the navigation is missing.
						meanShowChildren: true, // true to show children in the menu, false to hide them
						meanExpandableChildren: true, // true to allow expand/collapse children
						meanExpand: "+", // single character you want to represent the expand for ULs
						meanContract: "-", // single character you want to represent the contract for ULs
						meanRemoveAttrs: false, // true to remove classes and IDs, false to keep them
						onePage: false, // set to true for one page sites
						meanDisplay: "block", // override display method for table cell based layouts e.g. table-cell
						removeElements: "" // set to hide page elements
				};
				options = $.extend(defaults, options);

				// get browser width
				var currentWidth = window.innerWidth || document.documentElement.clientWidth;

				return this.each(function () {
						var meanMenu = options.meanMenuTarget;
						var meanContainer = options.meanMenuContainer;
						var meanMenuClose = options.meanMenuClose;
						var meanMenuCloseSize = options.meanMenuCloseSize;
						var meanMenuOpen = options.meanMenuOpen;
						var meanRevealPosition = options.meanRevealPosition;
						var meanRevealPositionDistance = options.meanRevealPositionDistance;
						var meanRevealColour = options.meanRevealColour;
						var meanScreenWidth = options.meanScreenWidth;
						var meanNavPush = options.meanNavPush;
						var meanRevealClass = ".meanmenu-reveal";
						var meanShowChildren = options.meanShowChildren;
						var meanExpandableChildren = options.meanExpandableChildren;
						var meanExpand = options.meanExpand;
						var meanContract = options.meanContract;
						var meanRemoveAttrs = options.meanRemoveAttrs;
						var onePage = options.onePage;
						var meanDisplay = options.meanDisplay;
						var removeElements = options.removeElements;

						//detect known mobile/tablet usage
						var isMobile = false;
						if ( (navigator.userAgent.match(/iPhone/i)) || (navigator.userAgent.match(/iPod/i)) || (navigator.userAgent.match(/iPad/i)) || (navigator.userAgent.match(/Android/i)) || (navigator.userAgent.match(/Blackberry/i)) || (navigator.userAgent.match(/Windows Phone/i)) ) {
								isMobile = true;
						}

						if ( (navigator.userAgent.match(/MSIE 8/i)) || (navigator.userAgent.match(/MSIE 7/i)) ) {
							// add scrollbar for IE7 & 8 to stop breaking resize function on small content sites
								jQuery('html').css("overflow-y" , "scroll");
						}

						var meanRevealPos = "";
						var meanCentered = function() {
							if (meanRevealPosition === "center") {
								var newWidth = window.innerWidth || document.documentElement.clientWidth;
								var meanCenter = ( (newWidth/2)-22 )+"px";
								meanRevealPos = "left:" + meanCenter + ";right:auto;";

								if (!isMobile) {
									jQuery('.meanmenu-reveal').css("left",meanCenter);
								} else {
									jQuery('.meanmenu-reveal').animate({
											left: meanCenter
									});
								}
							}
						};

						var menuOn = false;
						var meanMenuExist = false;


						if (meanRevealPosition === "right") {
								meanRevealPos = "right:" + meanRevealPositionDistance + ";left:auto;";
						}
						if (meanRevealPosition === "left") {
								meanRevealPos = "left:" + meanRevealPositionDistance + ";right:auto;";
						}
						// run center function
						meanCentered();

						// set all styles for mean-reveal
						var $navreveal = "";

						var meanInner = function() {
								// get last class name
								if (jQuery($navreveal).is(".meanmenu-reveal.meanclose")) {
										$navreveal.html(meanMenuClose);
								} else {
										$navreveal.html(meanMenuOpen);
								}
						};

						// re-instate original nav (and call this on window.width functions)
						var meanOriginal = function() {
							jQuery('.mean-bar,.mean-push').remove();
							jQuery(meanContainer).removeClass("mean-container");
							jQuery(meanMenu).css('display', meanDisplay);
							menuOn = false;
							meanMenuExist = false;
							jQuery(removeElements).removeClass('mean-remove');
						};

						// navigation reveal
						var showMeanMenu = function() {
								var meanStyles = "background:"+meanRevealColour+";color:"+meanRevealColour+";"+meanRevealPos;
								if (currentWidth <= meanScreenWidth) {
								jQuery(removeElements).addClass('mean-remove');
									meanMenuExist = true;
									// add class to body so we don't need to worry about media queries here, all CSS is wrapped in '.mean-container'
									jQuery(meanContainer).addClass("mean-container");
									jQuery('.mean-container').prepend('<div class="mean-bar"><a href="#nav" class="meanmenu-reveal" style="'+meanStyles+'">Show Navigation</a><nav class="mean-nav"></nav></div>');

									//push meanMenu navigation into .mean-nav
									var meanMenuContents = jQuery(meanMenu).html();
									jQuery('.mean-nav').html(meanMenuContents);

									// remove all classes from EVERYTHING inside meanmenu nav
									if(meanRemoveAttrs) {
										jQuery('nav.mean-nav ul, nav.mean-nav ul *').each(function() {
											// First check if this has mean-remove class
											if (jQuery(this).is('.mean-remove')) {
												jQuery(this).attr('class', 'mean-remove');
											} else {
												jQuery(this).removeAttr("class");
											}
											jQuery(this).removeAttr("id");
										});
									}

									// push in a holder div (this can be used if removal of nav is causing layout issues)
									jQuery(meanMenu).before('<div class="mean-push" />');
									jQuery('.mean-push').css("margin-top",meanNavPush);

									// hide current navigation and reveal mean nav link
									jQuery(meanMenu).hide();
									jQuery(".meanmenu-reveal").show();

									// turn 'X' on or off
									jQuery(meanRevealClass).html(meanMenuOpen);
									$navreveal = jQuery(meanRevealClass);

									//hide mean-nav ul
									jQuery('.mean-nav ul').hide();

									// hide sub nav
									if(meanShowChildren) {
											// allow expandable sub nav(s)
											if(meanExpandableChildren){
												jQuery('.mean-nav ul ul').each(function() {
														if(jQuery(this).children().length){
																jQuery(this,'li:first').parent().append('<a class="mean-expand" href="#" style="font-size: '+ meanMenuCloseSize +'">'+ meanExpand +'</a>');
														}
												});
												jQuery('.mean-expand').on("click",function(e){
														e.preventDefault();
															if (jQuery(this).hasClass("mean-clicked")) {
																	jQuery(this).text(meanExpand);
																jQuery(this).prev('ul').slideUp(300, function(){});
														} else {
																jQuery(this).text(meanContract);
																jQuery(this).prev('ul').slideDown(300, function(){});
														}
														jQuery(this).toggleClass("mean-clicked");
												});
											} else {
													jQuery('.mean-nav ul ul').show();
											}
									} else {
											jQuery('.mean-nav ul ul').hide();
									}

									// add last class to tidy up borders
									jQuery('.mean-nav ul li').last().addClass('mean-last');
									$navreveal.removeClass("meanclose");
									jQuery($navreveal).click(function(e){
										e.preventDefault();
								if( menuOn === false ) {
												$navreveal.css("text-align", "center");
												$navreveal.css("text-indent", "0");
												$navreveal.css("font-size", meanMenuCloseSize);
												jQuery('.mean-nav ul:first').slideDown();
												menuOn = true;
										} else {
											jQuery('.mean-nav ul:first').slideUp();
											menuOn = false;
										}
											$navreveal.toggleClass("meanclose");
											meanInner();
											jQuery(removeElements).addClass('mean-remove');
									});

									// for one page websites, reset all variables...
									if ( onePage ) {
										jQuery('.mean-nav ul > li > a:first-child').on( "click" , function () {
											jQuery('.mean-nav ul:first').slideUp();
											menuOn = false;
											jQuery($navreveal).toggleClass("meanclose").html(meanMenuOpen);
										});
									}
							} else {
								meanOriginal();
							}
						};

						if (!isMobile) {
								// reset menu on resize above meanScreenWidth
								jQuery(window).resize(function () {
										currentWidth = window.innerWidth || document.documentElement.clientWidth;
										if (currentWidth > meanScreenWidth) {
												meanOriginal();
										} else {
											meanOriginal();
										}
										if (currentWidth <= meanScreenWidth) {
												showMeanMenu();
												meanCentered();
										} else {
											meanOriginal();
										}
								});
						}

					jQuery(window).resize(function () {
								// get browser width
								currentWidth = window.innerWidth || document.documentElement.clientWidth;

								if (!isMobile) {
										meanOriginal();
										if (currentWidth <= meanScreenWidth) {
												showMeanMenu();
												meanCentered();
										}
								} else {
										meanCentered();
										if (currentWidth <= meanScreenWidth) {
												if (meanMenuExist === false) {
														showMeanMenu();
												}
										} else {
												meanOriginal();
										}
								}
						});

					// run main menuMenu function on load
					showMeanMenu();
				});
		};
})(jQuery);



// Place any jQuery/helper plugins in here.


/*========== Youtube Video Background ==========*/
/*
 /*jquery.mb.YTPlayer 23-01-2021
 _ jquery.mb.components 
 _ email: matbicoc@gmail.com 
 _ Copyright (c) 2001-2021. Matteo Bicocchi (Pupunzi); 
 _ blog: http://pupunzi.open-lab.com 
 _ Open Lab s.r.l., Florence - Italy 
 */

var ytp=ytp||{};let YTPRndSuffix=(new Date).getTime(),YTPTimerLabels={init:"YTPlayerInit_"+YTPRndSuffix,startPlaying:"YTPlayerStartPlay_"+YTPRndSuffix};function onYouTubeIframeAPIReady(){ytp.YTAPIReady||(ytp.YTAPIReady=!0,jQuery(document).trigger("YTAPIReady"))}let getYTPVideoID=function(e){let r,t;return e.indexOf("youtu.be")>0||e.indexOf("youtube.com/embed")>0?r=(t=(r=e.substr(e.lastIndexOf("/")+1,e.length)).indexOf("?list=")>0?r.substr(r.lastIndexOf("="),r.length):null)?r.substr(0,r.lastIndexOf("?")):r:e.indexOf("http")>-1?(r=e.match(/[\\?&]v=([^&#]*)/)[1],t=e.indexOf("list=")>0?e.match(/[\\?&]list=([^&#]*)/)[1]:null):t=(r=e.length>15?null:e)?null:e,{videoID:r,playlistID:t}};!function(jQuery,ytp){jQuery.mbYTPlayer={name:"jquery.mb.YTPlayer",version:"3.3.9",build:"7581",author:"Matteo Bicocchi (pupunzi)",apiKey:"",defaults:{videoURL:null,containment:"body",ratio:"auto",fadeOnStartTime:1e3,startAt:0,stopAt:0,autoPlay:!0,delayAtStart:1e3,coverImage:!1,loop:!0,addRaster:!1,mask:!1,opacity:1,quality:"hd1080",vol:50,mute:!1,showControls:!0,anchor:"center,center",showAnnotations:!1,cc_load_policy:!1,showYTLogo:!0,useOnMobile:!0,playOnlyIfVisible:!1,onScreenPercentage:30,goFullScreenOnPlay:!1,stopMovieOnBlur:!0,realFullscreen:!0,optimizeDisplay:!0,abundance:.3,gaTrack:!0,remember_last_time:!1,addFilters:!1,useNoCookie:!0,onReady:function(e){},onError:function(e,r){},onEnd:function(){}},controls:{play:"P",pause:"p",mute:"M",unmute:"A",onlyYT:"O",showSite:"R",ytLogo:"Y"},controlBar:null,locationProtocol:"https:",defaultFilters:{grayscale:{value:0,unit:"%"},hue_rotate:{value:0,unit:"deg"},invert:{value:0,unit:"%"},opacity:{value:0,unit:"%"},saturate:{value:0,unit:"%"},sepia:{value:0,unit:"%"},brightness:{value:0,unit:"%"},contrast:{value:0,unit:"%"},blur:{value:0,unit:"px"}},buildPlayer:function(options){if(ytp.YTAPIReady||void 0!==window.YT)setTimeout(function(){jQuery(document).trigger("YTAPIReady"),ytp.YTAPIReady=!0},100);else{jQuery("#YTAPI").remove();let e=jQuery("<script>").attr({src:"https://www.youtube.com/iframe_api?v="+jQuery.mbYTPlayer.version,id:"YTAPI"});jQuery("head").prepend(e)}function isIframe(){let e=!1;try{self.location.href!==top.location.href&&(e=!0)}catch(r){e=!0}return e}return this.each(function(){let YTPlayer=this,$YTPlayer=jQuery(YTPlayer);$YTPlayer.hide(),YTPlayer.loop=0,YTPlayer.state=0,YTPlayer.filters=jQuery.extend(!0,{},jQuery.mbYTPlayer.defaultFilters),YTPlayer.filtersEnabled=!0,YTPlayer.id=YTPlayer.id||"YTP_"+(new Date).getTime(),$YTPlayer.addClass("mb_YTPlayer");let property=$YTPlayer.data("property")&&"string"==typeof $YTPlayer.data("property")?eval("("+$YTPlayer.data("property")+")"):$YTPlayer.data("property");"object"!=typeof property&&(property={}),YTPlayer.opt=jQuery.extend(!0,{},jQuery.mbYTPlayer.defaults,YTPlayer.opt,options,property),YTPRndSuffix=getYTPVideoID(YTPlayer.opt.videoURL).videoID,YTPTimerLabels={init:"YTPlayerInit_"+YTPRndSuffix,startPlaying:"YTPlayerStartPlay_"+YTPRndSuffix},console.time(YTPTimerLabels.init),console.time(YTPTimerLabels.startPlaying),YTPlayer.opt.elementId=YTPlayer.id,0===YTPlayer.opt.vol&&(YTPlayer.opt.vol=1,YTPlayer.opt.mute=!0),YTPlayer.opt.loop&&"boolean"==typeof YTPlayer.opt.loop&&(YTPlayer.opt.loop=9999);let fullScreenAvailable=document.fullscreenEnabled||document.webkitFullscreenEnabled||document.mozFullScreenEnabled||document.msFullscreenEnabled;YTPlayer.opt.realFullscreen=!(isIframe()||!fullScreenAvailable)&&YTPlayer.opt.realFullscreen,YTPlayer.opt.showAnnotations=YTPlayer.opt.showAnnotations?"1":"3",YTPlayer.opt.cc_load_policy=YTPlayer.opt.cc_load_policy?"1":"0",YTPlayer.opt.coverImage=YTPlayer.opt.coverImage||YTPlayer.opt.backgroundImage,YTPlayer.opt.quality="hd1080",jQuery.mbBrowser.msie&&jQuery.mbBrowser.version<9&&(YTPlayer.opt.opacity=1),YTPlayer.opt.containment="self"===YTPlayer.opt.containment?$YTPlayer:jQuery(YTPlayer.opt.containment),YTPlayer.isRetina=window.retina||window.devicePixelRatio>1,YTPlayer.opt.ratio="auto"===YTPlayer.opt.ratio?16/9:YTPlayer.opt.ratio,YTPlayer.opt.ratio=eval(YTPlayer.opt.ratio);let origContainmentBackground=YTPlayer.opt.containment.css("background-image");origContainmentBackground="none"===origContainmentBackground?null:origContainmentBackground,YTPlayer.orig_containment_background=origContainmentBackground,$YTPlayer.attr("id")||$YTPlayer.attr("id","ytp_"+(new Date).getTime()),YTPlayer.playerID="iframe_"+YTPlayer.id,YTPlayer.isAlone=!1,YTPlayer.hasFocus=!0,YTPlayer.videoID=YTPlayer.opt.videoURL?getYTPVideoID(YTPlayer.opt.videoURL).videoID:!!$YTPlayer.attr("href")&&getYTPVideoID($YTPlayer.attr("href")).videoID,YTPlayer.playlistID=YTPlayer.opt.videoURL?getYTPVideoID(YTPlayer.opt.videoURL).playlistID:!!$YTPlayer.attr("href")&&getYTPVideoID($YTPlayer.attr("href")).playlistID;let start_from_last=0;if(jQuery.mbCookie.get("YTPlayer_start_from"+YTPlayer.videoID)&&(start_from_last=parseFloat(jQuery.mbCookie.get("YTPlayer_start_from"+YTPlayer.videoID))),YTPlayer.opt.remember_last_time&&start_from_last&&(YTPlayer.start_from_last=start_from_last,jQuery.mbCookie.remove("YTPlayer_start_from"+YTPlayer.videoID)),YTPlayer.isPlayer=$YTPlayer.is(YTPlayer.opt.containment),YTPlayer.isBackground=YTPlayer.opt.containment.is("body"),YTPlayer.isBackground&&ytp.backgroundIsInited)return;if(YTPlayer.isPlayer&&$YTPlayer.show(),YTPlayer.overlay=jQuery("<div/>").css({position:"absolute",top:0,left:0,width:"100%",height:"100%"}).addClass("YTPOverlay"),$YTPlayer.changeCoverImage(),YTPlayer.wrapper=jQuery("<div/>").attr("id","wrapper_"+YTPlayer.id).css({position:"absolute",zIndex:0,minWidth:"100%",minHeight:"100%",left:0,top:0,overflow:"hidden",opacity:0}).addClass("mbYTP_wrapper"),YTPlayer.isPlayer){let e=jQuery.mbBrowser.mobile?"inlinePlayButtonMobile":"inlinePlayButton";YTPlayer.inlinePlayButton=jQuery("<div/>").addClass("inlinePlayButton").html(jQuery.mbYTPlayer.controls.play),$YTPlayer.append(YTPlayer.inlinePlayButton),YTPlayer.inlinePlayButton.on("click",function(e){$YTPlayer.YTPPlay(),YTPlayer.inlinePlayButton.hide(),YTPlayer.opt.goFullScreenOnPlay&&$YTPlayer.YTPFullscreen(),e.stopPropagation()}),YTPlayer.opt.autoPlay&&YTPlayer.inlinePlayButton.hide(),YTPlayer.overlay.on("click",function(){$YTPlayer.YTPTogglePlay(),YTPlayer.opt.goFullScreenOnPlay&&$YTPlayer.YTPFullscreen()}).css({cursor:"pointer"})}let playerBox=jQuery("<div/>").attr("id",YTPlayer.playerID).addClass("playerBox");if(playerBox.css({position:"absolute",zIndex:0,width:"100%",height:"100%",top:0,left:0,overflow:"hidden",opacity:1}),YTPlayer.wrapper.append(playerBox),playerBox.after(YTPlayer.overlay),YTPlayer.isPlayer&&(YTPlayer.inlineWrapper=jQuery("<div/>").addClass("inline-YTPlayer"),YTPlayer.inlineWrapper.css({position:"relative",maxWidth:YTPlayer.opt.containment.css("width")}),YTPlayer.opt.containment.css({position:"relative",paddingBottom:"56.25%",overflow:"hidden",height:0}),YTPlayer.opt.containment.wrap(YTPlayer.inlineWrapper)),YTPlayer.opt.containment.children().not("script, style").each(function(){"static"===jQuery(this).css("position")&&jQuery(this).css("position","relative")}),YTPlayer.isBackground?(jQuery("body").css({boxSizing:"border-box"}),YTPlayer.wrapper.css({position:"fixed",top:0,left:0,zIndex:0})):"static"===YTPlayer.opt.containment.css("position")&&(YTPlayer.opt.containment.css({position:"relative"}),$YTPlayer.show()),YTPlayer.opt.containment.prepend(YTPlayer.wrapper),YTPlayer.isBackground||YTPlayer.overlay.on("mouseenter",function(){YTPlayer.controlBar&&YTPlayer.controlBar.length&&YTPlayer.controlBar.addClass("visible")}).on("mouseleave",function(){YTPlayer.controlBar&&YTPlayer.controlBar.length&&YTPlayer.controlBar.removeClass("visible")}),jQuery.mbBrowser.mobile&&!YTPlayer.opt.useOnMobile)return YTPlayer.opt.coverImage&&(YTPlayer.wrapper.css({backgroundImage:"url("+YTPlayer.opt.coverImage+")",backgroundPosition:"center center",backgroundSize:"cover",backgroundRepeat:"no-repeat",opacity:1}),YTPlayer.wrapper.css({opacity:1})),$YTPlayer;jQuery.mbBrowser.mobile&&YTPlayer.opt.autoPlay&&YTPlayer.opt.useOnMobile&&jQuery("body").one("touchstart",function(){YTPlayer.player.playVideo()}),jQuery(document).one("YTAPIReady",function(){$YTPlayer.trigger("YTAPIReady_"+YTPlayer.id),ytp.YTAPIReady=!0}),YTPlayer.isOnScreen=jQuery.mbYTPlayer.isOnScreen(YTPlayer,YTPlayer.opt.onScreenPercentage),$YTPlayer.one("YTAPIReady_"+YTPlayer.id,function(){let e=this,r=jQuery(e);e.isBackground&&ytp.backgroundIsInited||e.isInit||(e.isBackground&&(ytp.backgroundIsInited=!0),e.opt.autoPlay=void 0===e.opt.autoPlay?!!e.isBackground:e.opt.autoPlay,e.opt.vol=e.opt.vol?e.opt.vol:100,jQuery.mbYTPlayer.getDataFromAPI(e),jQuery(e).on("YTPChanged",function(t){if(e.isInit)return;e.isInit=!0;let a={modestbranding:1,autoplay:0,controls:0,showinfo:0,rel:0,enablejsapi:1,version:3,playerapiid:e.playerID,origin:"*",allowfullscreen:!0,wmode:"transparent",iv_load_policy:e.opt.showAnnotations,cc_load_policy:e.opt.cc_load_policy,playsinline:jQuery.mbBrowser.mobile&&!e.isPlayer?1:0,html5:document.createElement("video").canPlayType?1:0};new YT.Player(e.playerID,{host:e.opt.useNoCookie?"https://www.youtube-nocookie.com":"https://www.youtube.com",playerVars:a,events:{onReady:function(t){e.player=t.target,e.player.loadVideoById({videoId:e.videoID.toString(),suggestedQuality:e.opt.quality}),r.trigger("YTPlayerIsReady_"+e.id)},onStateChange:function(r){if("function"!=typeof r.target.getPlayerState)return;let t,a=r.target.getPlayerState();if(e.preventTrigger||e.isStarting)return void(e.preventTrigger=!1);switch(e.state=a,r.data===YT.PlayerState.PLAYING&&r.target.setPlaybackQuality(e.opt.quality),a){case-1:t="YTPUnstarted";break;case 0:t="YTPRealEnd";break;case 1:t="YTPPlay",e.controlBar.length&&e.controlBar.find(".mb_YTPPlayPause").html(jQuery.mbYTPlayer.controls.pause),e.isPlayer&&e.inlinePlayButton.hide(),jQuery(document).off("mousedown.YTPstart");break;case 2:t="YTPPause",e.controlBar.length&&e.controlBar.find(".mb_YTPPlayPause").html(jQuery.mbYTPlayer.controls.play),e.isPlayer&&e.inlinePlayButton.show();break;case 3:e.player.setPlaybackQuality(e.opt.quality),t="YTPBuffering",e.controlBar.length&&e.controlBar.find(".mb_YTPPlayPause").html(jQuery.mbYTPlayer.controls.play);break;case 5:t="YTPCued"}let o=jQuery.Event(t);o.time=e.currentTime,jQuery(e).trigger(o)},onPlaybackQualityChange:function(r){let t=r.target.getPlaybackQuality(),a=jQuery.Event("YTPQualityChange");a.quality=t,jQuery(e).trigger(a)},onError:function(t){switch("function"==typeof e.opt.onError&&e.opt.onError(r,t),console.debug("error:",t),t.data){case 2:console.error("video ID:: "+e.videoID+": The request contains an invalid parameter value. For example, this error occurs if you specify a video ID that does not have 11 characters, or if the video ID contains invalid characters, such as exclamation points or asterisks.");break;case 5:console.error("video ID:: "+e.videoID+": The requested content cannot be played in an HTML5 player or another error related to the HTML5 player has occurred.");break;case 100:console.error("video ID:: "+e.videoID+": The video requested was not found. This error occurs when a video has been removed (for any reason) or has been marked as private.");break;case 101:case 150:console.error("video ID:: "+e.videoID+": The video doesn't exist or The owner does not allow it to be played in embedded players.")}e.isList&&jQuery(e).YTPPlayNext()}}}),r.on("YTPlayerIsReady_"+e.id,function(){if(e.isReady)return this;e.playerEl=e.player.getIframe(),jQuery(e.playerEl).unselectable(),r.optimizeDisplay(),jQuery(window).off("resize.YTP_"+e.id).on("resize.YTP_"+e.id,function(){r.optimizeDisplay()}),jQuery(window).off("orientationchange.YTP_"+e.id).on("orientationchange.YTP_"+e.id,function(){r.optimizeDisplay()}),e.opt.remember_last_time&&jQuery(window).on("unload.YTP_"+e.id,function(){let r=e.player.getCurrentTime();jQuery.mbCookie.set("YTPlayer_start_from"+e.videoID,r,0)}),r.YTPCheckForState()})}))}),$YTPlayer.off("YTPTime.mask"),jQuery.mbYTPlayer.applyMask(YTPlayer),console.timeEnd(YTPTimerLabels.init),setTimeout(function(){ytp.YTAPIReady||"object"!=typeof window.YT||(jQuery(document).trigger("YTAPIReady"),ytp.YTAPIReady=!0,console.error("YTPlayer: More then a call to the YT API has been detected"))},YTPlayer.opt.delayAtStart)})},isOnScreen:function(e,r){r=r||10;let t=e.wrapper,a=jQuery(window).scrollTop(),o=a+jQuery(window).height(),n=t.height()*r/100,i=t.offset().top+n;return t.offset().top+(t.height()-n)<=o&&i>=a},getDataFromAPI:function(e){e.videoData=jQuery.mbStorage.get("YTPlayer_data_"+e.videoID),e.videoData?(setTimeout(function(){e.dataReceived=!0;let r=jQuery.Event("YTPChanged");r.time=e.currentTime,r.videoId=e.videoID,r.opt=e.opt,jQuery(e).trigger(r);let t=jQuery.Event("YTPData");t.prop={};for(let r in e.videoData)e.videoData.hasOwnProperty(r)&&(t.prop[r]=e.videoData[r]);jQuery(e).trigger(t)},e.opt.fadeOnStartTime),e.hasData=!0):jQuery.mbYTPlayer.apiKey?jQuery.getJSON("https://www.googleapis.com/youtube/v3/videos?id="+e.videoID+"&key="+jQuery.mbYTPlayer.apiKey+"&part=snippet",function(r){e.dataReceived=!0;let t=jQuery.Event("YTPChanged");t.time=e.currentTime,t.videoId=e.videoID,jQuery(e).trigger(t),r.items[0]?(!function(r){e.videoData={},e.videoData.id=e.videoID,e.videoData.channelTitle=r.channelTitle,e.videoData.title=r.title,e.videoData.description=r.description.length<400?r.description:r.description.substring(0,400)+" ...",e.videoData.thumb_max=r.thumbnails.maxres?r.thumbnails.maxres.url:null,e.videoData.thumb_high=r.thumbnails.high?r.thumbnails.high.url:null,e.videoData.thumb_medium=r.thumbnails.medium?r.thumbnails.medium.url:null,jQuery.mbStorage.set("YTPlayer_data_"+e.videoID,e.videoData)}(r.items[0].snippet),e.hasData=!0):(e.videoData={},e.hasData=!1);let a=jQuery.Event("YTPData");a.prop={};for(let r in e.videoData)a.prop[r]=e.videoData[r];jQuery(e).trigger(a)}).fail(function(r){console.error("YT data error:: ",r),e.hasData=!1;let t=jQuery.Event("YTPChanged");t.time=e.currentTime,t.videoId=e.videoID,jQuery(e).trigger(t)}):(setTimeout(function(){let r=jQuery.Event("YTPChanged");r.time=e.currentTime,r.videoId=e.videoID,jQuery(e).trigger(r)},10),e.videoData=null),e.opt.ratio="auto"==e.opt.ratio?16/9:e.opt.ratio,e.isPlayer&&!e.opt.autoPlay&&(e.loading=jQuery("<div/>").addClass("loading").html("Loading").hide(),jQuery(e).append(e.loading),e.loading.fadeIn())},removeStoredData:function(){jQuery.mbStorage.remove()},getVideoData:function(){return this.get(0).videoData},getVideoID:function(){return this.get(0).videoID||!1},getPlaylistID:function(){return this.get(0).playlistID||!1},setVideoQuality:function(e){let r=this.get(0),t=r.player.getCurrentTime();return jQuery(r).YTPPause(),r.opt.quality=e,r.player.setPlaybackQuality(e),r.player.seekTo(t),jQuery(r).YTPPlay(),this},getVideoQuality:function(){return this.get(0).player.getPlaybackQuality()},playlist:function(e,r,t){let a=this.get(0);return a.isList=!0,r&&(e=jQuery.shuffle(e)),a.videoID||(a.videos=e,a.videoCounter=1,a.videoLength=e.length,jQuery(a).data("property",e[0]),jQuery(a).YTPlayer()),"function"==typeof t&&jQuery(a).on("YTPChanged",function(){t(a)}),jQuery(a).on("YTPEnd",function(){jQuery(a).YTPPlayNext()}),this},playNext:function(){let e=this.get(0);return e.videoCounter++,e.videoCounter>e.videoLength&&(e.videoCounter=1),jQuery(e).YTPPlayIndex(e.videoCounter),this},playPrev:function(){let e=this.get(0);return e.videoCounter--,e.videoCounter<=0&&(e.videoCounter=e.videoLength),jQuery(e).YTPPlayIndex(e.videoCounter),this},playIndex:function(e){let r=this.get(0);r.checkForStartAt&&(clearInterval(r.checkForStartAt),clearInterval(r.getState)),r.videoCounter=e,r.videoCounter>=r.videoLength&&(r.videoCounter=r.videoLength);let t=r.videos[r.videoCounter-1];return jQuery(r).YTPChangeVideo(t),this},changeVideo:function(e){let r=this,t=r.get(0);t.opt.startAt=0,t.opt.stopAt=0,t.opt.mask=!1,t.opt.mute=!0,t.opt.autoPlay=!0,t.opt.addFilters=!1,t.opt.coverImage=!1,t.hasData=!1,t.hasChanged=!0,t.player.loopTime=void 0,e&&jQuery.extend(t.opt,e),t.videoID=getYTPVideoID(t.opt.videoURL).videoID,t.opt.loop&&"boolean"==typeof t.opt.loop&&(t.opt.loop=9999),t.wrapper.css({background:"none"}),jQuery(t.playerEl).CSSAnimate({opacity:0},t.opt.fadeOnStartTime,function(){jQuery.mbYTPlayer.getDataFromAPI(t),r.YTPGetPlayer().loadVideoById({videoId:t.videoID,suggestedQuality:t.opt.quality}),r.YTPPause(),r.optimizeDisplay(),t.checkForStartAt&&(clearInterval(t.checkForStartAt),clearInterval(t.getState)),r.YTPCheckForState()});let a=jQuery.Event("YTPChangeVideo");return a.time=t.currentTime,jQuery(t).trigger(a),jQuery.mbYTPlayer.applyMask(t),this},getPlayer:function(){let e=this.get(0);return e.isReady?e.player:null},playerDestroy:function(){let e=this.get(0);return e.isReady?(ytp.YTAPIReady=!0,ytp.backgroundIsInited=!1,e.isInit=!1,e.videoID=null,e.isReady=!1,e.wrapper.remove(),jQuery("#controlBar_"+e.id).remove(),clearInterval(e.checkForStartAt),clearInterval(e.getState),this):this},fullscreen:function(real){let YTPlayer=this.get(0);void 0===real&&(real=eval(YTPlayer.opt.realFullscreen));let controls=jQuery("#controlBar_"+YTPlayer.id),fullScreenBtn=controls.find(".mb_OnlyYT"),videoWrapper=YTPlayer.isPlayer?YTPlayer.opt.containment:YTPlayer.wrapper;if(real){let e=jQuery.mbBrowser.mozilla?"mozfullscreenchange":jQuery.mbBrowser.webkit?"webkitfullscreenchange":"fullscreenchange";jQuery(document).off(e).on(e,function(){RunPrefixMethod(document,"IsFullScreen")||RunPrefixMethod(document,"FullScreen")?jQuery(YTPlayer).trigger("YTPFullScreenStart"):(YTPlayer.isAlone=!1,fullScreenBtn.html(jQuery.mbYTPlayer.controls.onlyYT),jQuery(YTPlayer).YTPSetVideoQuality(YTPlayer.opt.quality),videoWrapper.removeClass("YTPFullscreen"),videoWrapper.CSSAnimate({opacity:YTPlayer.opt.opacity},YTPlayer.opt.fadeOnStartTime),videoWrapper.css({zIndex:0}),YTPlayer.isBackground?jQuery("body").after(controls):YTPlayer.wrapper.before(controls),jQuery(window).resize(),jQuery(YTPlayer).trigger("YTPFullScreenEnd"))})}if(YTPlayer.isAlone)jQuery(document).off("mousemove.YTPlayer"),clearTimeout(YTPlayer.hideCursor),YTPlayer.overlay.css({cursor:"auto"}),real?cancelFullscreen():(videoWrapper.CSSAnimate({opacity:YTPlayer.opt.opacity},YTPlayer.opt.fadeOnStartTime),videoWrapper.css({zIndex:0})),fullScreenBtn.html(jQuery.mbYTPlayer.controls.onlyYT),YTPlayer.isAlone=!1;else{function hideMouse(){YTPlayer.overlay.css({cursor:"none"})}jQuery(document).on("mousemove.YTPlayer",function(e){YTPlayer.overlay.css({cursor:"auto"}),clearTimeout(YTPlayer.hideCursor),jQuery(e.target).parents().is(".mb_YTPBar")||(YTPlayer.hideCursor=setTimeout(hideMouse,3e3))}),hideMouse(),real?(videoWrapper.css({opacity:0}),videoWrapper.addClass("YTPFullscreen"),launchFullscreen(videoWrapper.get(0)),setTimeout(function(){videoWrapper.CSSAnimate({opacity:1},2*YTPlayer.opt.fadeOnStartTime),videoWrapper.append(controls),jQuery(YTPlayer).optimizeDisplay(),YTPlayer.player.seekTo(YTPlayer.player.getCurrentTime()+.1,!0)},YTPlayer.opt.fadeOnStartTime)):videoWrapper.css({zIndex:1e4}).CSSAnimate({opacity:1},2*YTPlayer.opt.fadeOnStartTime),fullScreenBtn.html(jQuery.mbYTPlayer.controls.showSite),YTPlayer.isAlone=!0}function RunPrefixMethod(e,r){let t,a,o=["webkit","moz","ms","o",""],n=0;for(;n<o.length&&!e[t];){if(t=r,""===o[n]&&(t=t.substr(0,1).toLowerCase()+t.substr(1)),"undefined"!=(a=typeof e[t=o[n]+t]))return o=[o[n]],"function"==a?e[t]():e[t];n++}}function launchFullscreen(e){RunPrefixMethod(e,"RequestFullScreen")}function cancelFullscreen(){(RunPrefixMethod(document,"FullScreen")||RunPrefixMethod(document,"IsFullScreen"))&&RunPrefixMethod(document,"CancelFullScreen")}return this},toggleLoops:function(){let e=this.get(0),r=e.opt;return 1==r.loop?r.loop=0:(r.startAt?e.player.seekTo(r.startAt):e.player.playVideo(),r.loop=1),this},play:function(){let e=this.get(0),r=jQuery(e);return e.isReady?(setTimeout(function(){r.YTPSetAbundance(e.opt.abundance)},300),e.player.playVideo(),jQuery(e.playerEl).css({opacity:1}),e.wrapper.css({backgroundImage:"none"}),e.wrapper.CSSAnimate({opacity:e.isAlone?1:e.opt.opacity},e.opt.fadeOnStartTime),jQuery("#controlBar_"+e.id).find(".mb_YTPPlayPause").html(jQuery.mbYTPlayer.controls.pause),e.state=1,this):this},togglePlay:function(e){let r=this.get(0);return r.isReady?(1===r.state?this.YTPPause():this.YTPPlay(),"function"==typeof e&&e(r.state),this):this},stop:function(){let e=this.get(0);return e.isReady?(jQuery("#controlBar_"+e.id).find(".mb_YTPPlayPause").html(jQuery.mbYTPlayer.controls.play),e.player.stopVideo(),this):this},pause:function(){let e=this.get(0);return e.isReady?(e.opt.abundance<.2&&this.YTPSetAbundance(.2),e.player.pauseVideo(),e.state=2,this):this},seekTo:function(e){let r=this.get(0);return r.isReady?(r.player.seekTo(e,!0),this):this},getPlaybackRate:function(){let e=this.get(0);return e.isReady?e.player.getPlaybackRate():this},setPlaybackRate:function(e){let r=this.get(0);return r.isReady?(r.player.setPlaybackRate(e),this):this},setVolume:function(e){let r=this.get(0);return r.isReady?(r.opt.vol=e,this.YTPUnmute(),r.player.setVolume(r.opt.vol),r.volumeBar&&r.volumeBar.length&&r.volumeBar.updateSliderVal(e),this):this},getVolume:function(){let e=this.get(0);return e.isReady?e.player.getVolume():this},toggleVolume:function(){let e=this.get(0);return e.isReady?(e.isMute?(jQuery.mbBrowser.mobile||this.YTPSetVolume(e.opt.vol),this.YTPUnmute()):this.YTPMute(),this):this},mute:function(){let e=this.get(0);if(!e.isReady)return this;if(e.isMute)return this;e.player.mute(),e.isMute=!0,e.player.setVolume(0),e.volumeBar&&e.volumeBar.length&&e.volumeBar.width()>10&&e.volumeBar.updateSliderVal(0),jQuery("#controlBar_"+e.id).find(".mb_YTPMuteUnmute").html(jQuery.mbYTPlayer.controls.unmute),jQuery(e).addClass("isMuted"),e.volumeBar&&e.volumeBar.length&&e.volumeBar.addClass("muted");let r=jQuery.Event("YTPMuted");return r.time=e.currentTime,e.preventTrigger||jQuery(e).trigger(r),this},unmute:function(){let e=this.get(0);if(!e.isReady)return this;if(!e.isMute)return this;e.player.unMute(),e.isMute=!1,jQuery(e).YTPSetVolume(e.opt.vol),e.volumeBar&&e.volumeBar.length&&e.volumeBar.updateSliderVal(e.opt.vol>10?e.opt.vol:10),jQuery("#controlBar_"+e.id).find(".mb_YTPMuteUnmute").html(jQuery.mbYTPlayer.controls.mute),jQuery(e).removeClass("isMuted"),e.volumeBar&&e.volumeBar.length&&e.volumeBar.removeClass("muted");let r=jQuery.Event("YTPUnmuted");return r.time=e.currentTime,e.preventTrigger||jQuery(e).trigger(r),this},applyFilter:function(e,r){let t=this.get(0);if(!t.isReady)return this;t.filters[e].value=r,t.filtersEnabled&&this.YTPEnableFilters()},applyFilters:function(e){let r=this,t=r.get(0);if(!t.isReady)return jQuery(t).on("YTPReady",function(){r.YTPApplyFilters(e)}),this;for(let t in e)r.YTPApplyFilter(t,e[t]);r.trigger("YTPFiltersApplied")},toggleFilter:function(e,r){let t=this.get(0);return t.isReady?(t.filters[e].value?t.filters[e].value=0:t.filters[e].value=r,t.filtersEnabled&&jQuery(t).YTPEnableFilters(),this):this},toggleFilters:function(e){let r=this.get(0);return r.isReady?(r.filtersEnabled?(jQuery(r).trigger("YTPDisableFilters"),jQuery(r).YTPDisableFilters()):(jQuery(r).YTPEnableFilters(),jQuery(r).trigger("YTPEnableFilters")),"function"==typeof e&&e(r.filtersEnabled),this):this},disableFilters:function(){let e=this.get(0);if(!e.isReady)return this;let r=jQuery(e.playerEl);return r.css("-webkit-filter",""),r.css("filter",""),e.filtersEnabled=!1,this},enableFilters:function(){let e=this.get(0);if(!e.isReady)return this;let r=jQuery(e.playerEl),t="";for(let r in e.filters)e.filters[r].value&&(t+=r.replace("_","-")+"("+e.filters[r].value+e.filters[r].unit+") ");return r.css("-webkit-filter",t),r.css("filter",t),e.filtersEnabled=!0,this},removeFilter:function(e,r){let t=this,a=t.get(0);if(!a.isReady)return this;if("function"==typeof e&&(r=e,e=null),e)t.YTPApplyFilter(e,0),"function"==typeof r&&r(e);else{for(let e in a.filters)a.filters.hasOwnProperty(e)&&(t.YTPApplyFilter(e,0),"function"==typeof r&&r(e));a.filters=jQuery.extend(!0,{},jQuery.mbYTPlayer.defaultFilters)}let o=jQuery.Event("YTPFiltersApplied");return t.trigger(o),this},getFilters:function(){let e=this.get(0);return e.isReady?e.filters:this},addMask:function(e){let r=this.get(0);e||(e=r.actualMask);let t=jQuery("<img/>").attr("src",e).on("load",function(){r.overlay.CSSAnimate({opacity:0},r.opt.fadeOnStartTime,function(){r.hasMask=!0,t.remove(),r.overlay.css({backgroundImage:"url("+e+")",backgroundRepeat:"no-repeat",backgroundPosition:"center center",backgroundSize:"cover"}),r.overlay.CSSAnimate({opacity:1},r.opt.fadeOnStartTime)})});return this},removeMask:function(){let e=this.get(0);return e.overlay.CSSAnimate({opacity:0},e.opt.fadeOnStartTime,function(){e.hasMask=!1,e.overlay.css({backgroundImage:"",backgroundRepeat:"",backgroundPosition:"",backgroundSize:""}),e.overlay.CSSAnimate({opacity:1},e.opt.fadeOnStartTime)}),this},applyMask:function(e){let r=jQuery(e);if(r.off("YTPTime.mask"),e.opt.mask)if("string"==typeof e.opt.mask)r.YTPAddMask(e.opt.mask),e.actualMask=e.opt.mask;else if("object"==typeof e.opt.mask){for(let r in e.opt.mask)e.opt.mask[r]&&(img=jQuery("<img/>").attr("src",e.opt.mask[r]));e.opt.mask[0]&&r.YTPAddMask(e.opt.mask[0]),r.on("YTPTime.mask",function(t){for(let a in e.opt.mask)t.time===a&&(e.opt.mask[a]?(r.YTPAddMask(e.opt.mask[a]),e.actualMask=e.opt.mask[a]):r.YTPRemoveMask())})}},toggleMask:function(){let e=this.get(0),r=jQuery(e);return e.hasMask?r.YTPRemoveMask():r.YTPAddMask(),this},manageProgress:function(){let e=this.get(0),r=jQuery("#controlBar_"+e.id),t=r.find(".mb_YTPProgress"),a=r.find(".mb_YTPLoaded"),o=r.find(".mb_YTPseekbar"),n=t.outerWidth(),i=Math.floor(e.player.getCurrentTime()),l=Math.floor(e.player.getDuration()),s=i*n/l,u=100*e.player.getVideoLoadedFraction();return a.css({left:0,width:u+"%"}),o.css({left:0,width:s}),{totalTime:l,currentTime:i}},buildControls:function(YTPlayer){if(jQuery("#controlBar_"+YTPlayer.id).remove(),!YTPlayer.opt.showControls)return void(YTPlayer.controlBar=!1);if(YTPlayer.opt.showYTLogo=YTPlayer.opt.showYTLogo||YTPlayer.opt.printUrl,jQuery("#controlBar_"+YTPlayer.id).length)return;YTPlayer.controlBar=jQuery("<div/>").attr("id","controlBar_"+YTPlayer.id).addClass("mb_YTPBar").css({whiteSpace:"noWrap",position:YTPlayer.isBackground?"fixed":"absolute",zIndex:YTPlayer.isBackground?1e4:1e3}).hide().on("click",function(e){e.stopPropagation()});let buttonBar=jQuery("<div/>").addClass("buttonBar"),playpause=jQuery("<span>"+jQuery.mbYTPlayer.controls.play+"</span>").addClass("mb_YTPPlayPause ytpicon").on("click",function(e){e.stopPropagation(),jQuery(YTPlayer).YTPTogglePlay()}),MuteUnmute=jQuery("<span>"+jQuery.mbYTPlayer.controls.mute+"</span>").addClass("mb_YTPMuteUnmute ytpicon").on("click",function(e){e.stopPropagation(),jQuery(YTPlayer).YTPToggleVolume()}),volumeBar=jQuery("<div/>").addClass("mb_YTPVolumeBar").css({display:"inline-block"});YTPlayer.volumeBar=volumeBar;let idx=jQuery("<span/>").addClass("mb_YTPTime"),vURL=YTPlayer.opt.videoURL?YTPlayer.opt.videoURL:"";vURL.indexOf("http")<0&&(vURL="https://www.youtube.com/watch?v="+YTPlayer.opt.videoURL);let movieUrl=jQuery("<span/>").html(jQuery.mbYTPlayer.controls.ytLogo).addClass("mb_YTPUrl ytpicon").attr("title","view on YouTube").on("click",function(){window.open(vURL,"viewOnYT")}),onlyVideo=jQuery("<span/>").html(jQuery.mbYTPlayer.controls.onlyYT).addClass("mb_OnlyYT ytpicon").on("click",function(e){e.stopPropagation(),jQuery(YTPlayer).YTPFullscreen(YTPlayer.opt.realFullscreen)}),progressBar=jQuery("<div/>").addClass("mb_YTPProgress").css("position","absolute").on("click",function(e){e.stopPropagation(),timeBar.css({width:e.clientX-timeBar.offset().left}),YTPlayer.timeW=e.clientX-timeBar.offset().left,YTPlayer.controlBar.find(".mb_YTPLoaded").css({width:0});let r=Math.floor(YTPlayer.player.getDuration());YTPlayer.goto=timeBar.outerWidth()*r/progressBar.outerWidth(),YTPlayer.player.seekTo(parseFloat(YTPlayer.goto),!0),YTPlayer.controlBar.find(".mb_YTPLoaded").css({width:0})}),loadedBar=jQuery("<div/>").addClass("mb_YTPLoaded").css("position","absolute"),timeBar=jQuery("<div/>").addClass("mb_YTPseekbar").css("position","absolute");progressBar.append(loadedBar).append(timeBar),buttonBar.append(playpause).append(MuteUnmute).append(volumeBar).append(idx),YTPlayer.opt.showYTLogo&&buttonBar.append(movieUrl),(YTPlayer.isBackground||eval(YTPlayer.opt.realFullscreen)&&!YTPlayer.isBackground)&&buttonBar.append(onlyVideo),YTPlayer.controlBar.append(buttonBar).append(progressBar),YTPlayer.isBackground?jQuery("body").after(YTPlayer.controlBar):(YTPlayer.controlBar.addClass("inlinePlayer"),YTPlayer.wrapper.before(YTPlayer.controlBar)),volumeBar.simpleSlider({initialval:YTPlayer.opt.vol,scale:100,orientation:"h",callback:function(e){0==e.value?jQuery(YTPlayer).YTPMute():jQuery(YTPlayer).YTPUnmute(),YTPlayer.player.setVolume(e.value),YTPlayer.isMute||(YTPlayer.opt.vol=e.value)}})},changeCoverImage:function(e){let r=this.get(0);if(r.opt.coverImage||r.orig_containment_background){let t=e||(r.opt.coverImage?"url("+r.opt.coverImage+") center center":r.orig_containment_background);t&&r.opt.containment.css({background:t,backgroundSize:"cover",backgroundRepeat:"no-repeat",backgroundAttachment:"fixed"})}return this},checkForState:function(){let YTPlayer=this.get(0),$YTPlayer=jQuery(YTPlayer);clearInterval(YTPlayer.getState);let interval=100;if(!jQuery.contains(document,YTPlayer))return $YTPlayer.YTPPlayerDestroy(),clearInterval(YTPlayer.getState),void clearInterval(YTPlayer.checkForStartAt);jQuery.mbYTPlayer.checkForStart(YTPlayer),YTPlayer.getState=setInterval(function(){let $YTPlayer=jQuery(YTPlayer);if(!YTPlayer.isReady)return;let prog=jQuery(YTPlayer).YTPManageProgress(),stopAt=YTPlayer.opt.stopAt>YTPlayer.opt.startAt?YTPlayer.opt.stopAt:0;if(stopAt=stopAt<YTPlayer.player.getDuration()?stopAt:0,YTPlayer.currentTime!=prog.currentTime){let e=jQuery.Event("YTPTime");e.time=YTPlayer.currentTime,jQuery(YTPlayer).trigger(e)}if(YTPlayer.currentTime=prog.currentTime,YTPlayer.totalTime=YTPlayer.player.getDuration(),0==YTPlayer.player.getVolume()?$YTPlayer.addClass("isMuted"):$YTPlayer.removeClass("isMuted"),YTPlayer.opt.showControls&&(prog.totalTime?YTPlayer.controlBar.find(".mb_YTPTime").html(jQuery.mbYTPlayer.formatTime(prog.currentTime)+" / "+jQuery.mbYTPlayer.formatTime(prog.totalTime)):YTPlayer.controlBar.find(".mb_YTPTime").html("-- : -- / -- : --")),eval(YTPlayer.opt.stopMovieOnBlur)&&(document.hasFocus()?document.hasFocus()&&!YTPlayer.hasFocus&&-1!=YTPlayer.state&&0!=YTPlayer.state&&(YTPlayer.hasFocus=!0,YTPlayer.preventTrigger=!0,$YTPlayer.YTPPlay()):1==YTPlayer.state&&(YTPlayer.hasFocus=!1,YTPlayer.preventTrigger=!0,$YTPlayer.YTPPause())),YTPlayer.opt.playOnlyIfVisible){let e=jQuery.mbYTPlayer.isOnScreen(YTPlayer,YTPlayer.opt.onScreenPercentage);e||1!=YTPlayer.state?e&&!YTPlayer.isOnScreen&&(YTPlayer.isOnScreen=!0,YTPlayer.player.playVideo()):(YTPlayer.isOnScreen=!1,$YTPlayer.YTPPause())}if(YTPlayer.controlBar.length&&YTPlayer.controlBar.outerWidth()<=400&&!YTPlayer.isCompact?(YTPlayer.controlBar.addClass("compact"),YTPlayer.isCompact=!0,!YTPlayer.isMute&&YTPlayer.volumeBar&&YTPlayer.volumeBar.updateSliderVal(YTPlayer.opt.vol)):YTPlayer.controlBar.length&&YTPlayer.controlBar.outerWidth()>400&&YTPlayer.isCompact&&(YTPlayer.controlBar.removeClass("compact"),YTPlayer.isCompact=!1,!YTPlayer.isMute&&YTPlayer.volumeBar&&YTPlayer.volumeBar.updateSliderVal(YTPlayer.opt.vol)),YTPlayer.player.getPlayerState()>0&&(parseFloat(YTPlayer.player.getDuration()-YTPlayer.opt.fadeOnStartTime/1e3)<YTPlayer.player.getCurrentTime()||stopAt>0&&parseFloat(YTPlayer.player.getCurrentTime())>=stopAt)){if(YTPlayer.isEnded)return;if(YTPlayer.isEnded=!0,setTimeout(function(){YTPlayer.isEnded=!1},1e3),YTPlayer.isList){if(!YTPlayer.opt.loop||YTPlayer.opt.loop>0&&YTPlayer.player.loopTime===YTPlayer.opt.loop-1){YTPlayer.player.loopTime=void 0,clearInterval(YTPlayer.getState);let e=jQuery.Event("YTPEnd");return e.time=YTPlayer.currentTime,void jQuery(YTPlayer).trigger(e)}}else if(!YTPlayer.opt.loop||YTPlayer.opt.loop>0&&YTPlayer.player.loopTime===YTPlayer.opt.loop-1)return YTPlayer.player.loopTime=void 0,YTPlayer.state=2,$YTPlayer.changeCoverImage(YTPlayer),jQuery(YTPlayer).YTPPause(),void YTPlayer.wrapper.CSSAnimate({opacity:0},YTPlayer.opt.fadeOnStartTime,function(){YTPlayer.controlBar.length&&YTPlayer.controlBar.find(".mb_YTPPlayPause").html(jQuery.mbYTPlayer.controls.play),$YTPlayer.changeCoverImage();let e=jQuery.Event("YTPEnd");e.time=YTPlayer.currentTime,jQuery(YTPlayer).trigger(e),YTPlayer.player.seekTo(YTPlayer.opt.startAt,!0)});YTPlayer.player.loopTime=YTPlayer.player.loopTime?++YTPlayer.player.loopTime:1,YTPlayer.opt.startAt=YTPlayer.opt.startAt||1,YTPlayer.preventTrigger=!0,YTPlayer.state=2,YTPlayer.player.seekTo(YTPlayer.opt.startAt,!0)}},interval)},checkForStart:function(YTPlayer){let $YTPlayer=jQuery(YTPlayer);if(!jQuery.contains(document,YTPlayer))return void $YTPlayer.YTPPlayerDestroy();if(jQuery.mbYTPlayer.buildControls(YTPlayer),YTPlayer.overlay)if(YTPlayer.opt.addRaster){let e="dot"==YTPlayer.opt.addRaster?"raster-dot":"raster";YTPlayer.overlay.addClass(YTPlayer.isRetina?e+" retina":e)}else YTPlayer.overlay.removeClass(function(e,r){let t=r.split(" "),a=[];return jQuery.each(t,function(e,r){/raster.*/.test(r)&&a.push(r)}),a.push("retina"),a.join(" ")});YTPlayer.preventTrigger=!0,YTPlayer.state=2,YTPlayer.preventTrigger=!0,YTPlayer.player.mute(),YTPlayer.player.playVideo(),YTPlayer.isStarting=!0;let startAt=YTPlayer.start_from_last?YTPlayer.start_from_last:YTPlayer.opt.startAt?YTPlayer.opt.startAt:1;return YTPlayer.preventTrigger=!0,YTPlayer.checkForStartAt=setInterval(function(){YTPlayer.player.mute(),YTPlayer.player.seekTo(startAt,!0);let canPlayVideo=YTPlayer.player.getVideoLoadedFraction()>=startAt/YTPlayer.player.getDuration();if(jQuery.mbBrowser.mobile&&(canPlayVideo=!0),YTPlayer.player.getDuration()>0&&YTPlayer.player.getCurrentTime()>=startAt&&canPlayVideo){YTPlayer.start_from_last=null,YTPlayer.preventTrigger=!0,$YTPlayer.YTPPause(),clearInterval(YTPlayer.checkForStartAt),"function"==typeof YTPlayer.opt.onReady&&YTPlayer.opt.onReady(YTPlayer),YTPlayer.isReady=!0,$YTPlayer.YTPRemoveFilter(),YTPlayer.opt.addFilters?$YTPlayer.YTPApplyFilters(YTPlayer.opt.addFilters):$YTPlayer.YTPApplyFilters(),$YTPlayer.YTPEnableFilters();let YTPready=jQuery.Event("YTPReady");if(YTPready.time=YTPlayer.currentTime,$YTPlayer.trigger(YTPready),YTPlayer.state=2,YTPlayer.opt.mute?$YTPlayer.YTPMute():YTPlayer.opt.autoPlay?(console.debug("We muted the audio to make the video 'auto-play' according with the latest vendor policy. The audio will unmute at the first user interaction with the page"),YTPlayer.player.mute(),YTPlayer.forcedMuted=!0,jQuery(document).on("mousedown.YTPstartAudio",function(){YTPlayer.forcedMuted&&(console.debug("AAAAAAA"),YTPlayer.player.unMute(),YTPlayer.forcedMuted=!1,jQuery(document).off("mousedown.YTPstartAudio"))}),jQuery(window).on("scroll",function(){console.debug("AAAAA")})):YTPlayer.player.unMute(),"undefined"!=typeof _gaq&&eval(YTPlayer.opt.gaTrack)?_gaq.push(["_trackEvent","YTPlayer","Play",YTPlayer.hasData?YTPlayer.videoData.title:YTPlayer.videoID.toString()]):"undefined"!=typeof ga&&eval(YTPlayer.opt.gaTrack)&&ga("send","event","YTPlayer","play",YTPlayer.hasData?YTPlayer.videoData.title:YTPlayer.videoID.toString()),YTPlayer.opt.autoPlay){let e=jQuery.Event("YTPStart");e.time=YTPlayer.currentTime,jQuery(YTPlayer).trigger(e),YTPlayer.isStarting=!1,"mac"===jQuery.mbBrowser.os.name&&jQuery.mbBrowser.safari&&jQuery("body").one("mousedown.YTPstart",function(){$YTPlayer.YTPPlay()}),$YTPlayer.YTPPlay(),console.timeEnd(YTPTimerLabels.startPlaying)}else YTPlayer.preventTrigger=!0,$YTPlayer.YTPPause(),YTPlayer.start_from_last&&YTPlayer.player.seekTo(startAt,!0),setTimeout(function(){YTPlayer.preventTrigger=!0,$YTPlayer.YTPPause(),YTPlayer.isPlayer||(YTPlayer.opt.coverImage?(YTPlayer.wrapper.css({opacity:0}),setTimeout(function(){$YTPlayer.changeCoverImage()},YTPlayer.opt.fadeOnStartTime)):(jQuery(YTPlayer.playerEl).CSSAnimate({opacity:1},YTPlayer.opt.fadeOnStartTime),YTPlayer.wrapper.CSSAnimate({opacity:YTPlayer.isAlone?1:YTPlayer.opt.opacity},YTPlayer.opt.fadeOnStartTime))),YTPlayer.isStarting=!1},500),YTPlayer.controlBar.length&&YTPlayer.controlBar.find(".mb_YTPPlayPause").html(jQuery.mbYTPlayer.controls.play);YTPlayer.isPlayer&&!YTPlayer.opt.autoPlay&&YTPlayer.loading&&YTPlayer.loading.length&&(YTPlayer.loading.html("Ready"),setTimeout(function(){YTPlayer.loading.fadeOut()},100)),YTPlayer.controlBar&&YTPlayer.controlBar.length&&YTPlayer.controlBar.slideDown(1e3)}"mac"===jQuery.mbBrowser.os.name&&jQuery.mbBrowser.safari&&(YTPlayer.player.playVideo(),startAt>=0&&YTPlayer.player.seekTo(startAt,!0))},100),$YTPlayer},getTime:function(){let e=this.get(0);return jQuery.mbYTPlayer.formatTime(e.currentTime)},getTotalTime:function(){let e=this.get(0);return jQuery.mbYTPlayer.formatTime(e.totalTime)},formatTime:function(e){let r=Math.floor(e/60),t=Math.floor(e-60*r);return(r<=9?"0"+r:r)+" : "+(t<=9?"0"+t:t)},setAnchor:function(e){this.optimizeDisplay(e)},getAnchor:function(){return this.get(0).opt.anchor},setAbundance:function(e,r){let t=this.get(0);return r&&(t.opt.abundance=e),this.optimizeDisplay(t.opt.anchor,e),this},getAbundance:function(){return this.get(0).opt.abundance},setOption:function(e,r){return this.get(0).opt[e]=r,this}},jQuery.fn.optimizeDisplay=function(anchor,abundanceX){let YTPlayer=this.get(0),vid={},el=YTPlayer.wrapper,iframe=jQuery(YTPlayer.playerEl);YTPlayer.opt.anchor=anchor||YTPlayer.opt.anchor,YTPlayer.opt.anchor="undefined "!=typeof YTPlayer.opt.anchor?YTPlayer.opt.anchor:"center,center";let YTPAlign=YTPlayer.opt.anchor.split(","),ab=abundanceX||YTPlayer.opt.abundance;if(YTPlayer.opt.optimizeDisplay){let abundance=el.height()*ab,win={};win.width=el.outerWidth(),win.height=el.outerHeight()+abundance,YTPlayer.opt.ratio="auto"===YTPlayer.opt.ratio?16/9:YTPlayer.opt.ratio,YTPlayer.opt.ratio=eval(YTPlayer.opt.ratio),vid.width=win.width+abundance,vid.height=Math.ceil(vid.width/YTPlayer.opt.ratio),vid.marginTop=Math.ceil(-(vid.height-win.height+abundance)/2),vid.marginLeft=-abundance/2;let lowest=vid.height<win.height;lowest&&(vid.height=win.height+abundance,vid.width=Math.ceil(vid.height*YTPlayer.opt.ratio),vid.marginTop=-abundance/2,vid.marginLeft=Math.ceil(-(vid.width-win.width)/2));for(let e in YTPAlign)if(YTPAlign.hasOwnProperty(e)){let r=YTPAlign[e].replace(/ /g,"");switch(r){case"top":vid.marginTop=-abundance;break;case"bottom":vid.marginTop=Math.ceil(-(vid.height-win.height)-abundance/2);break;case"left":vid.marginLeft=-abundance;break;case"right":vid.marginLeft=Math.ceil(-(vid.width-win.width)+abundance/2)}}}else vid.width="100%",vid.height="100%",vid.marginTop=0,vid.marginLeft=0;iframe.css({width:vid.width,height:vid.height,marginTop:vid.marginTop,marginLeft:vid.marginLeft,maxWidth:"initial"})},jQuery.shuffle=function(e){let r=e.slice(),t=r.length,a=t;for(;a--;){let e=parseInt(Math.random()*t),o=r[a];r[a]=r[e],r[e]=o}return r},jQuery.fn.unselectable=function(){return this.each(function(){jQuery(this).css({"-moz-user-select":"none","-webkit-user-select":"none","user-select":"none"}).attr("unselectable","on")})},jQuery.fn.YTPlayer=jQuery.mbYTPlayer.buildPlayer,jQuery.fn.mb_YTPlayer=jQuery.mbYTPlayer.buildPlayer,jQuery.fn.YTPCheckForState=jQuery.mbYTPlayer.checkForState,jQuery.fn.YTPGetPlayer=jQuery.mbYTPlayer.getPlayer,jQuery.fn.YTPGetVideoID=jQuery.mbYTPlayer.getVideoID,jQuery.fn.YTPGetPlaylistID=jQuery.mbYTPlayer.getPlaylistID,jQuery.fn.YTPChangeVideo=jQuery.fn.YTPChangeMovie=jQuery.mbYTPlayer.changeVideo,jQuery.fn.YTPPlayerDestroy=jQuery.mbYTPlayer.playerDestroy,jQuery.fn.YTPPlay=jQuery.mbYTPlayer.play,jQuery.fn.YTPTogglePlay=jQuery.mbYTPlayer.togglePlay,jQuery.fn.YTPStop=jQuery.mbYTPlayer.stop,jQuery.fn.YTPPause=jQuery.mbYTPlayer.pause,jQuery.fn.YTPSeekTo=jQuery.mbYTPlayer.seekTo,jQuery.fn.YTPGetPlaybackRate=jQuery.mbYTPlayer.getPlaybackRate,jQuery.fn.YTPSetPlaybackRate=jQuery.mbYTPlayer.setPlaybackRate,jQuery.fn.changeCoverImage=jQuery.mbYTPlayer.changeCoverImage,jQuery.fn.YTPlaylist=jQuery.mbYTPlayer.playlist,jQuery.fn.YTPPlayNext=jQuery.mbYTPlayer.playNext,jQuery.fn.YTPPlayPrev=jQuery.mbYTPlayer.playPrev,jQuery.fn.YTPPlayIndex=jQuery.mbYTPlayer.playIndex,jQuery.fn.YTPMute=jQuery.mbYTPlayer.mute,jQuery.fn.YTPUnmute=jQuery.mbYTPlayer.unmute,jQuery.fn.YTPToggleVolume=jQuery.mbYTPlayer.toggleVolume,jQuery.fn.YTPSetVolume=jQuery.mbYTPlayer.setVolume,jQuery.fn.YTPGetVolume=jQuery.mbYTPlayer.getVolume,jQuery.fn.YTPGetVideoData=jQuery.mbYTPlayer.getVideoData,jQuery.fn.YTPFullscreen=jQuery.mbYTPlayer.fullscreen,jQuery.fn.YTPToggleLoops=jQuery.mbYTPlayer.toggleLoops,jQuery.fn.YTPManageProgress=jQuery.mbYTPlayer.manageProgress,jQuery.fn.YTPSetVideoQuality=jQuery.mbYTPlayer.setVideoQuality,jQuery.fn.YTPGetVideoQuality=jQuery.mbYTPlayer.getVideoQuality,jQuery.fn.YTPApplyFilter=jQuery.mbYTPlayer.applyFilter,jQuery.fn.YTPApplyFilters=jQuery.mbYTPlayer.applyFilters,jQuery.fn.YTPToggleFilter=jQuery.mbYTPlayer.toggleFilter,jQuery.fn.YTPToggleFilters=jQuery.mbYTPlayer.toggleFilters,jQuery.fn.YTPRemoveFilter=jQuery.mbYTPlayer.removeFilter,jQuery.fn.YTPDisableFilters=jQuery.mbYTPlayer.disableFilters,jQuery.fn.YTPEnableFilters=jQuery.mbYTPlayer.enableFilters,jQuery.fn.YTPGetFilters=jQuery.mbYTPlayer.getFilters,jQuery.fn.YTPGetTime=jQuery.mbYTPlayer.getTime,jQuery.fn.YTPGetTotalTime=jQuery.mbYTPlayer.getTotalTime,jQuery.fn.YTPAddMask=jQuery.mbYTPlayer.addMask,jQuery.fn.YTPRemoveMask=jQuery.mbYTPlayer.removeMask,jQuery.fn.YTPToggleMask=jQuery.mbYTPlayer.toggleMask,jQuery.fn.YTPGetAbundance=jQuery.mbYTPlayer.getAbundance,jQuery.fn.YTPSetAbundance=jQuery.mbYTPlayer.setAbundance,jQuery.fn.YTPSetAnchor=jQuery.mbYTPlayer.setAnchor,jQuery.fn.YTPGetAnchor=jQuery.mbYTPlayer.getAnchor,jQuery.fn.YTPSetOption=jQuery.mbYTPlayer.setOption}(jQuery,ytp);var nAgt=navigator.userAgent;function isTouchSupported(){var e=nAgt.msMaxTouchPoints,r="ontouchstart"in document.createElement("div");return!(!e&&!r)}jQuery.browser=jQuery.browser||{},jQuery.browser.mozilla=!1,jQuery.browser.webkit=!1,jQuery.browser.opera=!1,jQuery.browser.safari=!1,jQuery.browser.chrome=!1,jQuery.browser.androidStock=!1,jQuery.browser.msie=!1,jQuery.browser.edge=!1,jQuery.browser.ua=nAgt;var getOS=function(){var e={version:"Unknown version",name:"Unknown OS"};return-1!=navigator.appVersion.indexOf("Win")&&(e.name="Windows"),-1!=navigator.appVersion.indexOf("Mac")&&0>navigator.appVersion.indexOf("Mobile")&&(e.name="Mac"),-1!=navigator.appVersion.indexOf("Linux")&&(e.name="Linux"),/Mac OS X/.test(nAgt)&&!/Mobile/.test(nAgt)&&(e.version=/Mac OS X ([\._\d]+)/.exec(nAgt)[1],e.version=e.version.replace(/_/g,".").substring(0,5)),/Windows/.test(nAgt)&&(e.version="Unknown.Unknown"),/Windows NT 5.1/.test(nAgt)&&(e.version="5.1"),/Windows NT 6.0/.test(nAgt)&&(e.version="6.0"),/Windows NT 6.1/.test(nAgt)&&(e.version="6.1"),/Windows NT 6.2/.test(nAgt)&&(e.version="6.2"),/Windows NT 10.0/.test(nAgt)&&(e.version="10.0"),/Linux/.test(nAgt)&&/Linux/.test(nAgt)&&(e.version="Unknown.Unknown"),e.name=e.name.toLowerCase(),e.major_version="Unknown",e.minor_version="Unknown","Unknown.Unknown"!=e.version&&(e.major_version=parseFloat(e.version.split(".")[0]),e.minor_version=parseFloat(e.version.split(".")[1])),e},nameOffset,verOffset,ix;if(jQuery.browser.os=getOS(),jQuery.browser.hasTouch=isTouchSupported(),jQuery.browser.name=navigator.appName,jQuery.browser.fullVersion=""+parseFloat(navigator.appVersion),jQuery.browser.majorVersion=parseInt(navigator.appVersion,10),-1!=(verOffset=nAgt.indexOf("Opera")))jQuery.browser.opera=!0,jQuery.browser.name="Opera",jQuery.browser.fullVersion=nAgt.substring(verOffset+6),-1!=(verOffset=nAgt.indexOf("Version"))&&(jQuery.browser.fullVersion=nAgt.substring(verOffset+8));else if(-1!=(verOffset=nAgt.indexOf("OPR")))jQuery.browser.opera=!0,jQuery.browser.name="Opera",jQuery.browser.fullVersion=nAgt.substring(verOffset+4);else if(-1!=(verOffset=nAgt.indexOf("MSIE")))jQuery.browser.msie=!0,jQuery.browser.name="Microsoft Internet Explorer",jQuery.browser.fullVersion=nAgt.substring(verOffset+5);else if(-1!=nAgt.indexOf("Trident")){jQuery.browser.msie=!0,jQuery.browser.name="Microsoft Internet Explorer";var start=nAgt.indexOf("rv:")+3,end=start+4;jQuery.browser.fullVersion=nAgt.substring(start,end)}else-1!=(verOffset=nAgt.indexOf("Edge"))?(jQuery.browser.edge=!0,jQuery.browser.name="Microsoft Edge",jQuery.browser.fullVersion=nAgt.substring(verOffset+5)):-1!=(verOffset=nAgt.indexOf("Chrome"))?(jQuery.browser.webkit=!0,jQuery.browser.chrome=!0,jQuery.browser.name="Chrome",jQuery.browser.fullVersion=nAgt.substring(verOffset+7)):-1<nAgt.indexOf("mozilla/5.0")&&-1<nAgt.indexOf("android ")&&-1<nAgt.indexOf("applewebkit")&&!(-1<nAgt.indexOf("chrome"))?(verOffset=nAgt.indexOf("Chrome"),jQuery.browser.webkit=!0,jQuery.browser.androidStock=!0,jQuery.browser.name="androidStock",jQuery.browser.fullVersion=nAgt.substring(verOffset+7)):-1!=(verOffset=nAgt.indexOf("Safari"))?(jQuery.browser.webkit=!0,jQuery.browser.safari=!0,jQuery.browser.name="Safari",jQuery.browser.fullVersion=nAgt.substring(verOffset+7),-1!=(verOffset=nAgt.indexOf("Version"))&&(jQuery.browser.fullVersion=nAgt.substring(verOffset+8))):-1!=(verOffset=nAgt.indexOf("AppleWebkit"))?(jQuery.browser.webkit=!0,jQuery.browser.safari=!0,jQuery.browser.name="Safari",jQuery.browser.fullVersion=nAgt.substring(verOffset+7),-1!=(verOffset=nAgt.indexOf("Version"))&&(jQuery.browser.fullVersion=nAgt.substring(verOffset+8))):-1!=(verOffset=nAgt.indexOf("Firefox"))?(jQuery.browser.mozilla=!0,jQuery.browser.name="Firefox",jQuery.browser.fullVersion=nAgt.substring(verOffset+8)):(nameOffset=nAgt.lastIndexOf(" ")+1)<(verOffset=nAgt.lastIndexOf("/"))&&(jQuery.browser.name=nAgt.substring(nameOffset,verOffset),jQuery.browser.fullVersion=nAgt.substring(verOffset+1),jQuery.browser.name.toLowerCase()==jQuery.browser.name.toUpperCase()&&(jQuery.browser.name=navigator.appName));function uncamel(e){return e.replace(/([A-Z])/g,function(e){return"-"+e.toLowerCase()})}function setUnit(e,r){return"string"!=typeof e||e.match(/^[\-0-9\.]+jQuery/)?""+e+r:e}function setFilter(e,r,t){var a=uncamel(r),o=jQuery.browser.mozilla?"":jQuery.CSS.sfx;e[o+"filter"]=e[o+"filter"]||"",t=setUnit(t>jQuery.CSS.filters[r].max?jQuery.CSS.filters[r].max:t,jQuery.CSS.filters[r].unit),e[o+"filter"]+=a+"("+t+") ",delete e[r]}-1!=(ix=jQuery.browser.fullVersion.indexOf(";"))&&(jQuery.browser.fullVersion=jQuery.browser.fullVersion.substring(0,ix)),-1!=(ix=jQuery.browser.fullVersion.indexOf(" "))&&(jQuery.browser.fullVersion=jQuery.browser.fullVersion.substring(0,ix)),jQuery.browser.majorVersion=parseInt(""+jQuery.browser.fullVersion,10),isNaN(jQuery.browser.majorVersion)&&(jQuery.browser.fullVersion=""+parseFloat(navigator.appVersion),jQuery.browser.majorVersion=parseInt(navigator.appVersion,10)),jQuery.browser.version=jQuery.browser.majorVersion,jQuery.browser.android=/Android/i.test(nAgt),jQuery.browser.blackberry=/BlackBerry|BB|PlayBook/i.test(nAgt),jQuery.browser.ios=/iPhone|iPad|iPod|webOS/i.test(nAgt),jQuery.browser.operaMobile=/Opera Mini/i.test(nAgt),jQuery.browser.windowsMobile=/IEMobile|Windows Phone/i.test(nAgt),jQuery.browser.kindle=/Kindle|Silk/i.test(nAgt),jQuery.browser.mobile=jQuery.browser.android||jQuery.browser.blackberry||jQuery.browser.ios||jQuery.browser.windowsMobile||jQuery.browser.operaMobile||jQuery.browser.kindle,jQuery.isMobile=jQuery.browser.mobile,jQuery.isTablet=jQuery.browser.mobile&&765<jQuery(window).width(),jQuery.isAndroidDefault=jQuery.browser.android&&!/chrome/i.test(nAgt),jQuery.mbBrowser=jQuery.browser,jQuery.browser.versionCompare=function(e,r){if("stringstring"!=typeof e+typeof r)return!1;for(var t=e.split("."),a=r.split("."),o=0,n=Math.max(t.length,a.length);o<n;o++){if(t[o]&&!a[o]&&0<parseInt(t[o])||parseInt(t[o])>parseInt(a[o]))return 1;if(a[o]&&!t[o]&&0<parseInt(a[o])||parseInt(t[o])<parseInt(a[o]))return-1}return 0},jQuery.support.CSStransition=function(){var e=(document.body||document.documentElement).style;return void 0!==e.transition||void 0!==e.WebkitTransition||void 0!==e.MozTransition||void 0!==e.MsTransition||void 0!==e.OTransition}(),jQuery.CSS={name:"mb.CSSAnimate",author:"Matteo Bicocchi",version:"2.0.0",transitionEnd:"transitionEnd",sfx:"",filters:{blur:{min:0,max:100,unit:"px"},brightness:{min:0,max:400,unit:"%"},contrast:{min:0,max:400,unit:"%"},grayscale:{min:0,max:100,unit:"%"},hueRotate:{min:0,max:360,unit:"deg"},invert:{min:0,max:100,unit:"%"},saturate:{min:0,max:400,unit:"%"},sepia:{min:0,max:100,unit:"%"}},normalizeCss:function(e){var r=jQuery.extend(!0,{},e);for(var t in jQuery.browser.webkit||jQuery.browser.opera?jQuery.CSS.sfx="-webkit-":jQuery.browser.mozilla?jQuery.CSS.sfx="-moz-":jQuery.browser.msie&&(jQuery.CSS.sfx="-ms-"),jQuery.CSS.sfx="",r){if("transform"===t&&(r[jQuery.CSS.sfx+"transform"]=r[t],delete r[t]),"transform-origin"===t&&(r[jQuery.CSS.sfx+"transform-origin"]=e[t],delete r[t]),"filter"!==t||jQuery.browser.mozilla||(r[jQuery.CSS.sfx+"filter"]=e[t],delete r[t]),"blur"===t&&setFilter(r,"blur",e[t]),"brightness"===t&&setFilter(r,"brightness",e[t]),"contrast"===t&&setFilter(r,"contrast",e[t]),"grayscale"===t&&setFilter(r,"grayscale",e[t]),"hueRotate"===t&&setFilter(r,"hueRotate",e[t]),"invert"===t&&setFilter(r,"invert",e[t]),"saturate"===t&&setFilter(r,"saturate",e[t]),"sepia"===t&&setFilter(r,"sepia",e[t]),"x"===t){var a=jQuery.CSS.sfx+"transform";r[a]=r[a]||"",r[a]+=" translateX("+setUnit(e[t],"px")+")",delete r[t]}"y"===t&&(r[a=jQuery.CSS.sfx+"transform"]=r[a]||"",r[a]+=" translateY("+setUnit(e[t],"px")+")",delete r[t]),"z"===t&&(r[a=jQuery.CSS.sfx+"transform"]=r[a]||"",r[a]+=" translateZ("+setUnit(e[t],"px")+")",delete r[t]),"rotate"===t&&(r[a=jQuery.CSS.sfx+"transform"]=r[a]||"",r[a]+=" rotate("+setUnit(e[t],"deg")+")",delete r[t]),"rotateX"===t&&(r[a=jQuery.CSS.sfx+"transform"]=r[a]||"",r[a]+=" rotateX("+setUnit(e[t],"deg")+")",delete r[t]),"rotateY"===t&&(r[a=jQuery.CSS.sfx+"transform"]=r[a]||"",r[a]+=" rotateY("+setUnit(e[t],"deg")+")",delete r[t]),"rotateZ"===t&&(r[a=jQuery.CSS.sfx+"transform"]=r[a]||"",r[a]+=" rotateZ("+setUnit(e[t],"deg")+")",delete r[t]),"scale"===t&&(r[a=jQuery.CSS.sfx+"transform"]=r[a]||"",r[a]+=" scale("+setUnit(e[t],"")+")",delete r[t]),"scaleX"===t&&(r[a=jQuery.CSS.sfx+"transform"]=r[a]||"",r[a]+=" scaleX("+setUnit(e[t],"")+")",delete r[t]),"scaleY"===t&&(r[a=jQuery.CSS.sfx+"transform"]=r[a]||"",r[a]+=" scaleY("+setUnit(e[t],"")+")",delete r[t]),"scaleZ"===t&&(r[a=jQuery.CSS.sfx+"transform"]=r[a]||"",r[a]+=" scaleZ("+setUnit(e[t],"")+")",delete r[t]),"skew"===t&&(r[a=jQuery.CSS.sfx+"transform"]=r[a]||"",r[a]+=" skew("+setUnit(e[t],"deg")+")",delete r[t]),"skewX"===t&&(r[a=jQuery.CSS.sfx+"transform"]=r[a]||"",r[a]+=" skewX("+setUnit(e[t],"deg")+")",delete r[t]),"skewY"===t&&(r[a=jQuery.CSS.sfx+"transform"]=r[a]||"",r[a]+=" skewY("+setUnit(e[t],"deg")+")",delete r[t]),"perspective"===t&&(r[a=jQuery.CSS.sfx+"transform"]=r[a]||"",r[a]+=" perspective("+setUnit(e[t],"px")+")",delete r[t])}return r},getProp:function(e){var r,t=[];for(r in e)0>t.indexOf(r)&&t.push(uncamel(r));return t.join(",")},animate:function(e,r,t,a,o){return this.each(function(){function n(){i.called=!0,i.CSSAIsRunning=!1,l.off(jQuery.CSS.transitionEnd+"."+i.id),clearTimeout(i.timeout),l.css(jQuery.CSS.sfx+"transition",""),"function"==typeof o&&o.apply(i),"function"==typeof i.CSSqueue&&(i.CSSqueue(),i.CSSqueue=null)}var i=this,l=jQuery(this);i.id=i.id||"CSSA_"+(new Date).getTime();var s=s||{type:"noEvent"};if(i.CSSAIsRunning&&i.eventType==s.type&&!jQuery.browser.msie&&9>=jQuery.browser.version)i.CSSqueue=function(){l.CSSAnimate(e,r,t,a,o)};else if(i.CSSqueue=null,i.eventType=s.type,0!==l.length&&e){if(e=jQuery.normalizeCss(e),i.CSSAIsRunning=!0,"function"==typeof r&&(o=r,r=jQuery.fx.speeds._default),"function"==typeof t&&(a=t,t=0),"string"==typeof t&&(o=t,t=0),"function"==typeof a&&(o=a,a="cubic-bezier(0.65,0.03,0.36,0.72)"),"string"==typeof r)for(var u in jQuery.fx.speeds){if(r==u){r=jQuery.fx.speeds[u];break}r=jQuery.fx.speeds._default}if(r||(r=jQuery.fx.speeds._default),"string"==typeof o&&(a=o,o=null),jQuery.support.CSStransition){var y={default:"ease",in:"ease-in",out:"ease-out","in-out":"ease-in-out",snap:"cubic-bezier(0,1,.5,1)",easeOutCubic:"cubic-bezier(.215,.61,.355,1)",easeInOutCubic:"cubic-bezier(.645,.045,.355,1)",easeInCirc:"cubic-bezier(.6,.04,.98,.335)",easeOutCirc:"cubic-bezier(.075,.82,.165,1)",easeInOutCirc:"cubic-bezier(.785,.135,.15,.86)",easeInExpo:"cubic-bezier(.95,.05,.795,.035)",easeOutExpo:"cubic-bezier(.19,1,.22,1)",easeInOutExpo:"cubic-bezier(1,0,0,1)",easeInQuad:"cubic-bezier(.55,.085,.68,.53)",easeOutQuad:"cubic-bezier(.25,.46,.45,.94)",easeInOutQuad:"cubic-bezier(.455,.03,.515,.955)",easeInQuart:"cubic-bezier(.895,.03,.685,.22)",easeOutQuart:"cubic-bezier(.165,.84,.44,1)",easeInOutQuart:"cubic-bezier(.77,0,.175,1)",easeInQuint:"cubic-bezier(.755,.05,.855,.06)",easeOutQuint:"cubic-bezier(.23,1,.32,1)",easeInOutQuint:"cubic-bezier(.86,0,.07,1)",easeInSine:"cubic-bezier(.47,0,.745,.715)",easeOutSine:"cubic-bezier(.39,.575,.565,1)",easeInOutSine:"cubic-bezier(.445,.05,.55,.95)",easeInBack:"cubic-bezier(.6,-.28,.735,.045)",easeOutBack:"cubic-bezier(.175, .885,.32,1.275)",easeInOutBack:"cubic-bezier(.68,-.55,.265,1.55)"};y[a]&&(a=y[a]),l.off(jQuery.CSS.transitionEnd+"."+i.id),y=jQuery.CSS.getProp(e);var d={};jQuery.extend(d,e),d[jQuery.CSS.sfx+"transition-property"]=y,d[jQuery.CSS.sfx+"transition-duration"]=r+"ms",d[jQuery.CSS.sfx+"transition-delay"]=t+"ms",d[jQuery.CSS.sfx+"transition-timing-function"]=a,setTimeout(function(){l.one(jQuery.CSS.transitionEnd+"."+i.id,n),l.css(d)},1),i.timeout=setTimeout(function(){i.called||!o?(i.called=!1,i.CSSAIsRunning=!1):(l.css(jQuery.CSS.sfx+"transition",""),o.apply(i),i.CSSAIsRunning=!1,"function"==typeof i.CSSqueue&&(i.CSSqueue(),i.CSSqueue=null))},r+t+10)}else{for(y in e)"transform"===y&&delete e[y],"filter"===y&&delete e[y],"transform-origin"===y&&delete e[y],"auto"===e[y]&&delete e[y],"x"===y&&(s=e[y],e[u="left"]=s,delete e[y]),"y"===y&&(s=e[y],e[u="top"]=s,delete e[y]),"-ms-transform"!==y&&"-ms-filter"!==y||delete e[y];l.delay(t).animate(e,r,o)}}})}},jQuery.fn.CSSAnimate=jQuery.CSS.animate,jQuery.normalizeCss=jQuery.CSS.normalizeCss,jQuery.fn.css3=function(e){return this.each(function(){var r=jQuery(this),t=jQuery.normalizeCss(e);r.css(t)})},function(e){e.simpleSlider={defaults:{initialval:0,maxval:100,orientation:"h",readonly:!1,callback:!1},events:{start:e.browser.mobile?"touchstart":"mousedown",end:e.browser.mobile?"touchend":"mouseup",move:e.browser.mobile?"touchmove":"mousemove"},init:function(r){return this.each(function(){var t=this,a=e(t);a.addClass("simpleSlider"),t.opt={},e.extend(t.opt,e.simpleSlider.defaults,r),e.extend(t.opt,a.data());var o="h"===t.opt.orientation?"horizontal":"vertical";o=e("<div/>").addClass("level").addClass(o),a.prepend(o),t.level=o,a.css({cursor:"default"}),"auto"==t.opt.maxval&&(t.opt.maxval=e(t).outerWidth()),a.updateSliderVal(),t.opt.readonly||(a.on(e.simpleSlider.events.start,function(r){e.browser.mobile&&(r=r.changedTouches[0]),t.canSlide=!0,a.updateSliderVal(r),"h"===t.opt.orientation?a.css({cursor:"col-resize"}):a.css({cursor:"row-resize"}),t.lastVal=t.val,e.browser.mobile||(r.preventDefault(),r.stopPropagation())}),e(document).on(e.simpleSlider.events.move,function(r){e.browser.mobile&&(r=r.changedTouches[0]),t.canSlide&&(e(document).css({cursor:"default"}),a.updateSliderVal(r),e.browser.mobile||(r.preventDefault(),r.stopPropagation()))}).on(e.simpleSlider.events.end,function(){e(document).css({cursor:"auto"}),t.canSlide=!1,a.css({cursor:"auto"})}))})},updateSliderVal:function(r){var t=this.get(0);if(t.opt){t.opt.initialval="number"==typeof t.opt.initialval?t.opt.initialval:t.opt.initialval(t);var a=e(t).outerWidth(),o=e(t).outerHeight();t.x="object"==typeof r?r.clientX+document.body.scrollLeft-this.offset().left:"number"==typeof r?r*a/t.opt.maxval:t.opt.initialval*a/t.opt.maxval,t.y="object"==typeof r?r.clientY+document.body.scrollTop-this.offset().top:"number"==typeof r?(t.opt.maxval-t.opt.initialval-r)*o/t.opt.maxval:t.opt.initialval*o/t.opt.maxval,t.y=this.outerHeight()-t.y,t.scaleX=t.x*t.opt.maxval/a,t.scaleY=t.y*t.opt.maxval/o,t.outOfRangeX=t.scaleX>t.opt.maxval?t.scaleX-t.opt.maxval:0>t.scaleX?t.scaleX:0,t.outOfRangeY=t.scaleY>t.opt.maxval?t.scaleY-t.opt.maxval:0>t.scaleY?t.scaleY:0,t.outOfRange="h"===t.opt.orientation?t.outOfRangeX:t.outOfRangeY,t.value=void 0!==r?"h"===t.opt.orientation?t.x>=this.outerWidth()?t.opt.maxval:0>=t.x?0:t.scaleX:t.y>=this.outerHeight()?t.opt.maxval:0>=t.y?0:t.scaleY:"h"===t.opt.orientation?t.scaleX:t.scaleY,"h"===t.opt.orientation?t.level.width(Math.floor(100*t.x/a)+"%"):t.level.height(Math.floor(100*t.y/o)),t.lastVal===t.value&&("h"===t.opt.orientation&&(t.x>=this.outerWidth()||0>=t.x)||"h"!==t.opt.orientation&&(t.y>=this.outerHeight()||0>=t.y))||("function"==typeof t.opt.callback&&t.opt.callback(t),t.lastVal=t.value)}}},e.fn.simpleSlider=e.simpleSlider.init,e.fn.updateSliderVal=e.simpleSlider.updateSliderVal}(jQuery),function(e){e.mbCookie={set:function(e,r,t,a){"object"==typeof r&&(r=JSON.stringify(r)),a=a?"; domain="+a:"";var o=new Date,n="";0<t&&(o.setTime(o.getTime()+864e5*t),n="; expires="+o.toGMTString()),document.cookie=e+"="+r+n+"; path=/"+a},get:function(e){e+="=";for(var r=document.cookie.split(";"),t=0;t<r.length;t++){for(var a=r[t];" "==a.charAt(0);)a=a.substring(1,a.length);if(0==a.indexOf(e))try{return JSON.parse(a.substring(e.length,a.length))}catch(r){return a.substring(e.length,a.length)}}return null},remove:function(r){e.mbCookie.set(r,"",-1)}},e.mbStorage={set:function(e,r){"object"==typeof r&&(r=JSON.stringify(r)),localStorage.setItem(e,r)},get:function(e){if(!localStorage[e])return null;try{return JSON.parse(localStorage[e])}catch(r){return localStorage[e]}},remove:function(e){e?localStorage.removeItem(e):localStorage.clear()}}}(jQuery);var nAgt=navigator.userAgent;function isTouchSupported(){var e=nAgt.msMaxTouchPoints,r="ontouchstart"in document.createElement("div");return!(!e&&!r)}jQuery.mbBrowser={},jQuery.mbBrowser.mozilla=!1,jQuery.mbBrowser.webkit=!1,jQuery.mbBrowser.opera=!1,jQuery.mbBrowser.safari=!1,jQuery.mbBrowser.chrome=!1,jQuery.mbBrowser.androidStock=!1,jQuery.mbBrowser.msie=!1,jQuery.mbBrowser.edge=!1,jQuery.mbBrowser.ua=nAgt;var getOS=function(){var e={version:"Unknown version",name:"Unknown OS"};return-1!=navigator.appVersion.indexOf("Win")&&(e.name="Windows"),-1!=navigator.appVersion.indexOf("Mac")&&0>navigator.appVersion.indexOf("Mobile")&&(e.name="Mac"),-1!=navigator.appVersion.indexOf("Linux")&&(e.name="Linux"),/Mac OS X/.test(nAgt)&&!/Mobile/.test(nAgt)&&(e.version=/Mac OS X ([\._\d]+)/.exec(nAgt)[1],e.version=e.version.replace(/_/g,".").substring(0,5)),/Windows/.test(nAgt)&&(e.version="Unknown.Unknown"),/Windows NT 5.1/.test(nAgt)&&(e.version="5.1"),/Windows NT 6.0/.test(nAgt)&&(e.version="6.0"),/Windows NT 6.1/.test(nAgt)&&(e.version="6.1"),/Windows NT 6.2/.test(nAgt)&&(e.version="6.2"),/Windows NT 10.0/.test(nAgt)&&(e.version="10.0"),/Linux/.test(nAgt)&&/Linux/.test(nAgt)&&(e.version="Unknown.Unknown"),e.name=e.name.toLowerCase(),e.major_version="Unknown",e.minor_version="Unknown","Unknown.Unknown"!=e.version&&(e.major_version=parseFloat(e.version.split(".")[0]),e.minor_version=parseFloat(e.version.split(".")[1])),e},nameOffset,verOffset,ix;if(jQuery.mbBrowser.os=getOS(),jQuery.mbBrowser.hasTouch=isTouchSupported(),jQuery.mbBrowser.name=navigator.appName,jQuery.mbBrowser.fullVersion=""+parseFloat(navigator.appVersion),jQuery.mbBrowser.majorVersion=parseInt(navigator.appVersion,10),-1!=(verOffset=nAgt.indexOf("Opera")))jQuery.mbBrowser.opera=!0,jQuery.mbBrowser.name="Opera",jQuery.mbBrowser.fullVersion=nAgt.substring(verOffset+6),-1!=(verOffset=nAgt.indexOf("Version"))&&(jQuery.mbBrowser.fullVersion=nAgt.substring(verOffset+8));else if(-1!=(verOffset=nAgt.indexOf("OPR")))jQuery.mbBrowser.opera=!0,jQuery.mbBrowser.name="Opera",jQuery.mbBrowser.fullVersion=nAgt.substring(verOffset+4);else if(-1!=(verOffset=nAgt.indexOf("MSIE")))jQuery.mbBrowser.msie=!0,jQuery.mbBrowser.name="Microsoft Internet Explorer",jQuery.mbBrowser.fullVersion=nAgt.substring(verOffset+5);else if(-1!=nAgt.indexOf("Trident")){jQuery.mbBrowser.msie=!0,jQuery.mbBrowser.name="Microsoft Internet Explorer";var start=nAgt.indexOf("rv:")+3,end=start+4;jQuery.mbBrowser.fullVersion=nAgt.substring(start,end)}else-1!=(verOffset=nAgt.indexOf("Edge"))?(jQuery.mbBrowser.edge=!0,jQuery.mbBrowser.name="Microsoft Edge",jQuery.mbBrowser.fullVersion=nAgt.substring(verOffset+5)):-1!=(verOffset=nAgt.indexOf("Chrome"))?(jQuery.mbBrowser.webkit=!0,jQuery.mbBrowser.chrome=!0,jQuery.mbBrowser.name="Chrome",jQuery.mbBrowser.fullVersion=nAgt.substring(verOffset+7)):-1<nAgt.indexOf("mozilla/5.0")&&-1<nAgt.indexOf("android ")&&-1<nAgt.indexOf("applewebkit")&&!(-1<nAgt.indexOf("chrome"))?(verOffset=nAgt.indexOf("Chrome"),jQuery.mbBrowser.webkit=!0,jQuery.mbBrowser.androidStock=!0,jQuery.mbBrowser.name="androidStock",jQuery.mbBrowser.fullVersion=nAgt.substring(verOffset+7)):-1!=(verOffset=nAgt.indexOf("Safari"))?(jQuery.mbBrowser.webkit=!0,jQuery.mbBrowser.safari=!0,jQuery.mbBrowser.name="Safari",jQuery.mbBrowser.fullVersion=nAgt.substring(verOffset+7),-1!=(verOffset=nAgt.indexOf("Version"))&&(jQuery.mbBrowser.fullVersion=nAgt.substring(verOffset+8))):-1!=(verOffset=nAgt.indexOf("AppleWebkit"))?(jQuery.mbBrowser.webkit=!0,jQuery.mbBrowser.safari=!0,jQuery.mbBrowser.name="Safari",jQuery.mbBrowser.fullVersion=nAgt.substring(verOffset+7),-1!=(verOffset=nAgt.indexOf("Version"))&&(jQuery.mbBrowser.fullVersion=nAgt.substring(verOffset+8))):-1!=(verOffset=nAgt.indexOf("Firefox"))?(jQuery.mbBrowser.mozilla=!0,jQuery.mbBrowser.name="Firefox",jQuery.mbBrowser.fullVersion=nAgt.substring(verOffset+8)):(nameOffset=nAgt.lastIndexOf(" ")+1)<(verOffset=nAgt.lastIndexOf("/"))&&(jQuery.mbBrowser.name=nAgt.substring(nameOffset,verOffset),jQuery.mbBrowser.fullVersion=nAgt.substring(verOffset+1),jQuery.mbBrowser.name.toLowerCase()==jQuery.mbBrowser.name.toUpperCase()&&(jQuery.mbBrowser.name=navigator.appName));-1!=(ix=jQuery.mbBrowser.fullVersion.indexOf(";"))&&(jQuery.mbBrowser.fullVersion=jQuery.mbBrowser.fullVersion.substring(0,ix)),-1!=(ix=jQuery.mbBrowser.fullVersion.indexOf(" "))&&(jQuery.mbBrowser.fullVersion=jQuery.mbBrowser.fullVersion.substring(0,ix)),jQuery.mbBrowser.majorVersion=parseInt(""+jQuery.mbBrowser.fullVersion,10),isNaN(jQuery.mbBrowser.majorVersion)&&(jQuery.mbBrowser.fullVersion=""+parseFloat(navigator.appVersion),jQuery.mbBrowser.majorVersion=parseInt(navigator.appVersion,10)),jQuery.mbBrowser.version=jQuery.mbBrowser.majorVersion,jQuery.mbBrowser.android=/Android/i.test(nAgt),jQuery.mbBrowser.blackberry=/BlackBerry|BB|PlayBook/i.test(nAgt),jQuery.mbBrowser.ios=/iPhone|iPad|iPod|webOS/i.test(nAgt),jQuery.mbBrowser.operaMobile=/Opera Mini/i.test(nAgt),jQuery.mbBrowser.windowsMobile=/IEMobile|Windows Phone/i.test(nAgt),jQuery.mbBrowser.kindle=/Kindle|Silk/i.test(nAgt),jQuery.mbBrowser.mobile=jQuery.mbBrowser.android||jQuery.mbBrowser.blackberry||jQuery.mbBrowser.ios||jQuery.mbBrowser.windowsMobile||jQuery.mbBrowser.operaMobile||jQuery.mbBrowser.kindle,jQuery.isMobile=jQuery.mbBrowser.mobile,jQuery.isTablet=jQuery.mbBrowser.mobile&&765<jQuery(window).width(),jQuery.isAndroidDefault=jQuery.mbBrowser.android&&!/chrome/i.test(nAgt),jQuery.mbBrowser=jQuery.mbBrowser,jQuery.mbBrowser.versionCompare=function(e,r){if("stringstring"!=typeof e+typeof r)return!1;for(var t=e.split("."),a=r.split("."),o=0,n=Math.max(t.length,a.length);o<n;o++){if(t[o]&&!a[o]&&0<parseInt(t[o])||parseInt(t[o])>parseInt(a[o]))return 1;if(a[o]&&!t[o]&&0<parseInt(a[o])||parseInt(t[o])<parseInt(a[o]))return-1}return 0};



 /*
  * ******************************************************************************
  *  jquery.mb.components
  *  file: jquery.mb.CSSAnimate.min.js
  *
  *  Copyright (c) 2001-2014. Matteo Bicocchi (Pupunzi);
  *  Open lab srl, Firenze - Italy
  *  email: matteo@open-lab.com
  *  site: 	http://pupunzi.com
  *  blog:	http://pupunzi.open-lab.com
  * 	http://open-lab.com
  *
  *  Licences: MIT, GPL
  *  http://www.opensource.org/licenses/mit-license.php
  *  http://www.gnu.org/licenses/gpl.html
  *
  *  last modified: 26/03/14 21.40
  *  *****************************************************************************
  */
 
 function uncamel(e){return e.replace(/([A-Z])/g,function(e){return"-"+e.toLowerCase()})}function setUnit(e,t){return"string"!=typeof e||e.match(/^[\-0-9\.]+jQuery/)?""+e+t:e}function setFilter(e,t,r){var i=uncamel(t),n=jQuery.browser.mozilla?"":jQuery.CSS.sfx;e[n+"filter"]=e[n+"filter"]||"",r=setUnit(r>jQuery.CSS.filters[t].max?jQuery.CSS.filters[t].max:r,jQuery.CSS.filters[t].unit),e[n+"filter"]+=i+"("+r+") ",delete e[t]}jQuery.support.CSStransition=function(){var e=document.body||document.documentElement,t=e.style;return void 0!==t.transition||void 0!==t.WebkitTransition||void 0!==t.MozTransition||void 0!==t.MsTransition||void 0!==t.OTransition}(),jQuery.CSS={name:"mb.CSSAnimate",author:"Matteo Bicocchi",version:"2.0.0",transitionEnd:"transitionEnd",sfx:"",filters:{blur:{min:0,max:100,unit:"px"},brightness:{min:0,max:400,unit:"%"},contrast:{min:0,max:400,unit:"%"},grayscale:{min:0,max:100,unit:"%"},hueRotate:{min:0,max:360,unit:"deg"},invert:{min:0,max:100,unit:"%"},saturate:{min:0,max:400,unit:"%"},sepia:{min:0,max:100,unit:"%"}},normalizeCss:function(e){var t=jQuery.extend(!0,{},e);jQuery.browser.webkit||jQuery.browser.opera?jQuery.CSS.sfx="-webkit-":jQuery.browser.mozilla?jQuery.CSS.sfx="-moz-":jQuery.browser.msie&&(jQuery.CSS.sfx="-ms-");for(var r in t){"transform"===r&&(t[jQuery.CSS.sfx+"transform"]=t[r],delete t[r]),"transform-origin"===r&&(t[jQuery.CSS.sfx+"transform-origin"]=e[r],delete t[r]),"filter"!==r||jQuery.browser.mozilla||(t[jQuery.CSS.sfx+"filter"]=e[r],delete t[r]),"blur"===r&&setFilter(t,"blur",e[r]),"brightness"===r&&setFilter(t,"brightness",e[r]),"contrast"===r&&setFilter(t,"contrast",e[r]),"grayscale"===r&&setFilter(t,"grayscale",e[r]),"hueRotate"===r&&setFilter(t,"hueRotate",e[r]),"invert"===r&&setFilter(t,"invert",e[r]),"saturate"===r&&setFilter(t,"saturate",e[r]),"sepia"===r&&setFilter(t,"sepia",e[r]);var i="";"x"===r&&(i=jQuery.CSS.sfx+"transform",t[i]=t[i]||"",t[i]+=" translateX("+setUnit(e[r],"px")+")",delete t[r]),"y"===r&&(i=jQuery.CSS.sfx+"transform",t[i]=t[i]||"",t[i]+=" translateY("+setUnit(e[r],"px")+")",delete t[r]),"z"===r&&(i=jQuery.CSS.sfx+"transform",t[i]=t[i]||"",t[i]+=" translateZ("+setUnit(e[r],"px")+")",delete t[r]),"rotate"===r&&(i=jQuery.CSS.sfx+"transform",t[i]=t[i]||"",t[i]+=" rotate("+setUnit(e[r],"deg")+")",delete t[r]),"rotateX"===r&&(i=jQuery.CSS.sfx+"transform",t[i]=t[i]||"",t[i]+=" rotateX("+setUnit(e[r],"deg")+")",delete t[r]),"rotateY"===r&&(i=jQuery.CSS.sfx+"transform",t[i]=t[i]||"",t[i]+=" rotateY("+setUnit(e[r],"deg")+")",delete t[r]),"rotateZ"===r&&(i=jQuery.CSS.sfx+"transform",t[i]=t[i]||"",t[i]+=" rotateZ("+setUnit(e[r],"deg")+")",delete t[r]),"scale"===r&&(i=jQuery.CSS.sfx+"transform",t[i]=t[i]||"",t[i]+=" scale("+setUnit(e[r],"")+")",delete t[r]),"scaleX"===r&&(i=jQuery.CSS.sfx+"transform",t[i]=t[i]||"",t[i]+=" scaleX("+setUnit(e[r],"")+")",delete t[r]),"scaleY"===r&&(i=jQuery.CSS.sfx+"transform",t[i]=t[i]||"",t[i]+=" scaleY("+setUnit(e[r],"")+")",delete t[r]),"scaleZ"===r&&(i=jQuery.CSS.sfx+"transform",t[i]=t[i]||"",t[i]+=" scaleZ("+setUnit(e[r],"")+")",delete t[r]),"skew"===r&&(i=jQuery.CSS.sfx+"transform",t[i]=t[i]||"",t[i]+=" skew("+setUnit(e[r],"deg")+")",delete t[r]),"skewX"===r&&(i=jQuery.CSS.sfx+"transform",t[i]=t[i]||"",t[i]+=" skewX("+setUnit(e[r],"deg")+")",delete t[r]),"skewY"===r&&(i=jQuery.CSS.sfx+"transform",t[i]=t[i]||"",t[i]+=" skewY("+setUnit(e[r],"deg")+")",delete t[r]),"perspective"===r&&(i=jQuery.CSS.sfx+"transform",t[i]=t[i]||"",t[i]+=" perspective("+setUnit(e[r],"px")+")",delete t[r])}return t},getProp:function(e){var t=[];for(var r in e)t.indexOf(r)<0&&t.push(uncamel(r));return t.join(",")},animate:function(e,t,r,i,n){return this.each(function(){function s(){u.called=!0,u.CSSAIsRunning=!1,a.off(jQuery.CSS.transitionEnd+"."+u.id),clearTimeout(u.timeout),a.css(jQuery.CSS.sfx+"transition",""),"function"==typeof n&&n.apply(u),"function"==typeof u.CSSqueue&&(u.CSSqueue(),u.CSSqueue=null)}var u=this,a=jQuery(this);u.id=u.id||"CSSA_"+(new Date).getTime();var o=o||{type:"noEvent"};if(u.CSSAIsRunning&&u.eventType==o.type&&!jQuery.browser.msie&&jQuery.browser.version<=9)return void(u.CSSqueue=function(){a.CSSAnimate(e,t,r,i,n)});if(u.CSSqueue=null,u.eventType=o.type,0!==a.length&&e){if(e=jQuery.normalizeCss(e),u.CSSAIsRunning=!0,"function"==typeof t&&(n=t,t=jQuery.fx.speeds._default),"function"==typeof r&&(i=r,r=0),"string"==typeof r&&(n=r,r=0),"function"==typeof i&&(n=i,i="cubic-bezier(0.65,0.03,0.36,0.72)"),"string"==typeof t)for(var f in jQuery.fx.speeds){if(t==f){t=jQuery.fx.speeds[f];break}t=jQuery.fx.speeds._default}if(t||(t=jQuery.fx.speeds._default),"string"==typeof n&&(i=n,n=null),!jQuery.support.CSStransition){for(var c in e){if("transform"===c&&delete e[c],"filter"===c&&delete e[c],"transform-origin"===c&&delete e[c],"auto"===e[c]&&delete e[c],"x"===c){var S=e[c],l="left";e[l]=S,delete e[c]}if("y"===c){var S=e[c],l="top";e[l]=S,delete e[c]}("-ms-transform"===c||"-ms-filter"===c)&&delete e[c]}return void a.delay(r).animate(e,t,n)}var y={"default":"ease","in":"ease-in",out:"ease-out","in-out":"ease-in-out",snap:"cubic-bezier(0,1,.5,1)",easeOutCubic:"cubic-bezier(.215,.61,.355,1)",easeInOutCubic:"cubic-bezier(.645,.045,.355,1)",easeInCirc:"cubic-bezier(.6,.04,.98,.335)",easeOutCirc:"cubic-bezier(.075,.82,.165,1)",easeInOutCirc:"cubic-bezier(.785,.135,.15,.86)",easeInExpo:"cubic-bezier(.95,.05,.795,.035)",easeOutExpo:"cubic-bezier(.19,1,.22,1)",easeInOutExpo:"cubic-bezier(1,0,0,1)",easeInQuad:"cubic-bezier(.55,.085,.68,.53)",easeOutQuad:"cubic-bezier(.25,.46,.45,.94)",easeInOutQuad:"cubic-bezier(.455,.03,.515,.955)",easeInQuart:"cubic-bezier(.895,.03,.685,.22)",easeOutQuart:"cubic-bezier(.165,.84,.44,1)",easeInOutQuart:"cubic-bezier(.77,0,.175,1)",easeInQuint:"cubic-bezier(.755,.05,.855,.06)",easeOutQuint:"cubic-bezier(.23,1,.32,1)",easeInOutQuint:"cubic-bezier(.86,0,.07,1)",easeInSine:"cubic-bezier(.47,0,.745,.715)",easeOutSine:"cubic-bezier(.39,.575,.565,1)",easeInOutSine:"cubic-bezier(.445,.05,.55,.95)",easeInBack:"cubic-bezier(.6,-.28,.735,.045)",easeOutBack:"cubic-bezier(.175, .885,.32,1.275)",easeInOutBack:"cubic-bezier(.68,-.55,.265,1.55)"};y[i]&&(i=y[i]),a.off(jQuery.CSS.transitionEnd+"."+u.id);var m=jQuery.CSS.getProp(e),d={};jQuery.extend(d,e),d[jQuery.CSS.sfx+"transition-property"]=m,d[jQuery.CSS.sfx+"transition-duration"]=t+"ms",d[jQuery.CSS.sfx+"transition-delay"]=r+"ms",d[jQuery.CSS.sfx+"transition-timing-function"]=i,setTimeout(function(){a.one(jQuery.CSS.transitionEnd+"."+u.id,s),a.css(d)},1),u.timeout=setTimeout(function(){return u.called||!n?(u.called=!1,void(u.CSSAIsRunning=!1)):(a.css(jQuery.CSS.sfx+"transition",""),n.apply(u),u.CSSAIsRunning=!1,void("function"==typeof u.CSSqueue&&(u.CSSqueue(),u.CSSqueue=null)))},t+r+10)}})}},jQuery.fn.CSSAnimate=jQuery.CSS.animate,jQuery.normalizeCss=jQuery.CSS.normalizeCss,jQuery.fn.css3=function(e){return this.each(function(){var t=jQuery(this),r=jQuery.normalizeCss(e);t.css(r)})};
 ;/*
  * ******************************************************************************
  *  jquery.mb.components
  *  file: jquery.mb.browser.min.js
  *
  *  Copyright (c) 2001-2014. Matteo Bicocchi (Pupunzi);
  *  Open lab srl, Firenze - Italy
  *  email: matteo@open-lab.com
  *  site: 	http://pupunzi.com
  *  blog:	http://pupunzi.open-lab.com
  * 	http://open-lab.com
  *
  *  Licences: MIT, GPL
  *  http://www.opensource.org/licenses/mit-license.php
  *  http://www.gnu.org/licenses/gpl.html
  *
  *  last modified: 26/03/14 21.43
  *  *****************************************************************************
  */
 
 var nAgt=navigator.userAgent;if(!jQuery.browser){jQuery.browser={},jQuery.browser.mozilla=!1,jQuery.browser.webkit=!1,jQuery.browser.opera=!1,jQuery.browser.safari=!1,jQuery.browser.chrome=!1,jQuery.browser.androidStock=!1,jQuery.browser.msie=!1,jQuery.browser.ua=nAgt,jQuery.browser.name=navigator.appName,jQuery.browser.fullVersion=""+parseFloat(navigator.appVersion),jQuery.browser.majorVersion=parseInt(navigator.appVersion,10);var nameOffset,verOffset,ix;if(-1!=(verOffset=nAgt.indexOf("Opera")))jQuery.browser.opera=!0,jQuery.browser.name="Opera",jQuery.browser.fullVersion=nAgt.substring(verOffset+6),-1!=(verOffset=nAgt.indexOf("Version"))&&(jQuery.browser.fullVersion=nAgt.substring(verOffset+8));else if(-1!=(verOffset=nAgt.indexOf("OPR")))jQuery.browser.opera=!0,jQuery.browser.name="Opera",jQuery.browser.fullVersion=nAgt.substring(verOffset+4);else if(-1!=(verOffset=nAgt.indexOf("MSIE")))jQuery.browser.msie=!0,jQuery.browser.name="Microsoft Internet Explorer",jQuery.browser.fullVersion=nAgt.substring(verOffset+5);else if(-1!=nAgt.indexOf("Trident")||-1!=nAgt.indexOf("Edge")){jQuery.browser.msie=!0,jQuery.browser.name="Microsoft Internet Explorer";var start=nAgt.indexOf("rv:")+3,end=start+4;jQuery.browser.fullVersion=nAgt.substring(start,end)}else-1!=(verOffset=nAgt.indexOf("Chrome"))?(jQuery.browser.webkit=!0,jQuery.browser.chrome=!0,jQuery.browser.name="Chrome",jQuery.browser.fullVersion=nAgt.substring(verOffset+7)):nAgt.indexOf("mozilla/5.0")>-1&&nAgt.indexOf("android ")>-1&&nAgt.indexOf("applewebkit")>-1&&!(nAgt.indexOf("chrome")>-1)?(verOffset=nAgt.indexOf("Chrome"),jQuery.browser.webkit=!0,jQuery.browser.androidStock=!0,jQuery.browser.name="androidStock",jQuery.browser.fullVersion=nAgt.substring(verOffset+7)):-1!=(verOffset=nAgt.indexOf("Safari"))?(jQuery.browser.webkit=!0,jQuery.browser.safari=!0,jQuery.browser.name="Safari",jQuery.browser.fullVersion=nAgt.substring(verOffset+7),-1!=(verOffset=nAgt.indexOf("Version"))&&(jQuery.browser.fullVersion=nAgt.substring(verOffset+8))):-1!=(verOffset=nAgt.indexOf("AppleWebkit"))?(jQuery.browser.webkit=!0,jQuery.browser.safari=!0,jQuery.browser.name="Safari",jQuery.browser.fullVersion=nAgt.substring(verOffset+7),-1!=(verOffset=nAgt.indexOf("Version"))&&(jQuery.browser.fullVersion=nAgt.substring(verOffset+8))):-1!=(verOffset=nAgt.indexOf("Firefox"))?(jQuery.browser.mozilla=!0,jQuery.browser.name="Firefox",jQuery.browser.fullVersion=nAgt.substring(verOffset+8)):(nameOffset=nAgt.lastIndexOf(" ")+1)<(verOffset=nAgt.lastIndexOf("/"))&&(jQuery.browser.name=nAgt.substring(nameOffset,verOffset),jQuery.browser.fullVersion=nAgt.substring(verOffset+1),jQuery.browser.name.toLowerCase()==jQuery.browser.name.toUpperCase()&&(jQuery.browser.name=navigator.appName));-1!=(ix=jQuery.browser.fullVersion.indexOf(";"))&&(jQuery.browser.fullVersion=jQuery.browser.fullVersion.substring(0,ix)),-1!=(ix=jQuery.browser.fullVersion.indexOf(" "))&&(jQuery.browser.fullVersion=jQuery.browser.fullVersion.substring(0,ix)),jQuery.browser.majorVersion=parseInt(""+jQuery.browser.fullVersion,10),isNaN(jQuery.browser.majorVersion)&&(jQuery.browser.fullVersion=""+parseFloat(navigator.appVersion),jQuery.browser.majorVersion=parseInt(navigator.appVersion,10)),jQuery.browser.version=jQuery.browser.majorVersion}jQuery.browser.android=/Android/i.test(nAgt),jQuery.browser.blackberry=/BlackBerry|BB|PlayBook/i.test(nAgt),jQuery.browser.ios=/iPhone|iPad|iPod|webOS/i.test(nAgt),jQuery.browser.operaMobile=/Opera Mini/i.test(nAgt),jQuery.browser.windowsMobile=/IEMobile|Windows Phone/i.test(nAgt),jQuery.browser.kindle=/Kindle|Silk/i.test(nAgt),jQuery.browser.mobile=jQuery.browser.android||jQuery.browser.blackberry||jQuery.browser.ios||jQuery.browser.windowsMobile||jQuery.browser.operaMobile||jQuery.browser.kindle,jQuery.isMobile=jQuery.browser.mobile,jQuery.isTablet=jQuery.browser.mobile&&jQuery(window).width()>765,jQuery.isAndroidDefault=jQuery.browser.android&&!/chrome/i.test(nAgt);
 ;/*___________________________________________________________________________________________________________________________________________________
  _ jquery.mb.components                                                                                                                             _
  _                                                                                                                                                  _
  _ file: jquery.mb.simpleSlider.min.js                                                                                                              _
  _ last modified: 16/05/15 23.45                                                                                                                    _
  _                                                                                                                                                  _
  _ Open Lab s.r.l., Florence - Italy                                                                                                                _
  _                                                                                                                                                  _
  _ email: matteo@open-lab.com                                                                                                                       _
  _ site: http://pupunzi.com                                                                                                                         _
  _       http://open-lab.com                                                                                                                        _
  _ blog: http://pupunzi.open-lab.com                                                                                                                _
  _ Q&A:  http://jquery.pupunzi.com                                                                                                                  _
  _                                                                                                                                                  _
  _ Licences: MIT, GPL                                                                                                                               _
  _    http://www.opensource.org/licenses/mit-license.php                                                                                            _
  _    http://www.gnu.org/licenses/gpl.html                                                                                                          _
  _                                                                                                                                                  _
  _ Copyright (c) 2001-2015. Matteo Bicocchi (Pupunzi);                                                                                              _
  ___________________________________________________________________________________________________________________________________________________*/
 
 !function(e){var t=(/iphone|ipod|ipad|android|ie|blackberry|fennec/.test(navigator.userAgent.toLowerCase()),"ontouchstart"in window||window.navigator&&window.navigator.msPointerEnabled&&window.MSGesture||window.DocumentTouch&&document instanceof DocumentTouch||!1);e.simpleSlider={defaults:{initialval:0,scale:100,orientation:"h",readonly:!1,callback:!1},events:{start:t?"touchstart":"mousedown",end:t?"touchend":"mouseup",move:t?"touchmove":"mousemove"},init:function(o){return this.each(function(){var a=this,l=e(a);l.addClass("simpleSlider"),a.opt={},e.extend(a.opt,e.simpleSlider.defaults,o),e.extend(a.opt,l.data());var i="h"==a.opt.orientation?"horizontal":"vertical",n=e("<div/>").addClass("level").addClass(i);l.prepend(n),a.level=n,l.css({cursor:"default"}),"auto"==a.opt.scale&&(a.opt.scale=e(a).outerWidth()),l.updateSliderVal(),a.opt.readonly||(l.on(e.simpleSlider.events.start,function(e){t&&(e=e.changedTouches[0]),a.canSlide=!0,l.updateSliderVal(e),l.css({cursor:"col-resize"}),e.preventDefault(),e.stopPropagation()}),e(document).on(e.simpleSlider.events.move,function(o){t&&(o=o.changedTouches[0]),a.canSlide&&(e(document).css({cursor:"default"}),l.updateSliderVal(o),o.preventDefault(),o.stopPropagation())}).on(e.simpleSlider.events.end,function(){e(document).css({cursor:"auto"}),a.canSlide=!1,l.css({cursor:"auto"})}))})},updateSliderVal:function(t){function o(e,t){return Math.floor(100*e/t)}var a=this,l=a.get(0);if(l.opt){l.opt.initialval="number"==typeof l.opt.initialval?l.opt.initialval:l.opt.initialval(l);var i=e(l).outerWidth(),n=e(l).outerHeight();l.x="object"==typeof t?t.clientX+document.body.scrollLeft-a.offset().left:"number"==typeof t?t*i/l.opt.scale:l.opt.initialval*i/l.opt.scale,l.y="object"==typeof t?t.clientY+document.body.scrollTop-a.offset().top:"number"==typeof t?(l.opt.scale-l.opt.initialval-t)*n/l.opt.scale:l.opt.initialval*n/l.opt.scale,l.y=a.outerHeight()-l.y,l.scaleX=l.x*l.opt.scale/i,l.scaleY=l.y*l.opt.scale/n,l.outOfRangeX=l.scaleX>l.opt.scale?l.scaleX-l.opt.scale:l.scaleX<0?l.scaleX:0,l.outOfRangeY=l.scaleY>l.opt.scale?l.scaleY-l.opt.scale:l.scaleY<0?l.scaleY:0,l.outOfRange="h"==l.opt.orientation?l.outOfRangeX:l.outOfRangeY,"undefined"!=typeof t?l.value="h"==l.opt.orientation?l.x>=a.outerWidth()?l.opt.scale:l.x<=0?0:l.scaleX:l.y>=a.outerHeight()?l.opt.scale:l.y<=0?0:l.scaleY:l.value="h"==l.opt.orientation?l.scaleX:l.scaleY,"h"==l.opt.orientation?l.level.width(o(l.x,i)+"%"):l.level.height(o(l.y,n)),"function"==typeof l.opt.callback&&l.opt.callback(l)}}},e.fn.simpleSlider=e.simpleSlider.init,e.fn.updateSliderVal=e.simpleSlider.updateSliderVal}(jQuery);
 ;/*___________________________________________________________________________________________________________________________________________________
  _ jquery.mb.components                                                                                                                             _
  _                                                                                                                                                  _
  _ file: jquery.mb.storage.min.js                                                                                                                   _
  _ last modified: 24/05/15 16.08                                                                                                                    _
  _                                                                                                                                                  _
  _ Open Lab s.r.l., Florence - Italy                                                                                                                _
  _                                                                                                                                                  _
  _ email: matteo@open-lab.com                                                                                                                       _
  _ site: http://pupunzi.com                                                                                                                         _
  _       http://open-lab.com                                                                                                                        _
  _ blog: http://pupunzi.open-lab.com                                                                                                                _
  _ Q&A:  http://jquery.pupunzi.com                                                                                                                  _
  _                                                                                                                                                  _
  _ Licences: MIT, GPL                                                                                                                               _
  _    http://www.opensource.org/licenses/mit-license.php                                                                                            _
  _    http://www.gnu.org/licenses/gpl.html                                                                                                          _
  _                                                                                                                                                  _
  _ Copyright (c) 2001-2015. Matteo Bicocchi (Pupunzi);                                                                                              _
  ___________________________________________________________________________________________________________________________________________________*/
 
 !function(a){a.mbCookie={set:function(a,b,c,d){b=JSON.stringify(b),c||(c=7),d=d?"; domain="+d:"";var f,e=new Date;e.setTime(e.getTime()+1e3*60*60*24*c),f="; expires="+e.toGMTString(),document.cookie=a+"="+b+f+"; path=/"+d},get:function(a){for(var b=a+"=",c=document.cookie.split(";"),d=0;d<c.length;d++){for(var e=c[d];" "==e.charAt(0);)e=e.substring(1,e.length);if(0==e.indexOf(b))return JSON.parse(e.substring(b.length,e.length))}return null},remove:function(b){a.mbCookie.set(b,"",-1)}},a.mbStorage={set:function(a,b){b=JSON.stringify(b),localStorage.setItem(a,b)},get:function(a){return localStorage[a]?JSON.parse(localStorage[a]):null},remove:function(a){a?localStorage.removeItem(a):localStorage.clear()}}}(jQuery);



/*-------------------------------------------------------------
    08. jQquery Ripples js
---------------------------------------------------------------*/
/**
 * jQuery Ripples plugin v0.6.2 / https://github.com/sirxemic/jquery.ripples
 * MIT License
 * @author sirxemic / https://sirxemic.com/
 */
!function(e,t){"object"==typeof exports&&"undefined"!=typeof module?t(require("jquery")):"function"==typeof define&&define.amd?define(["jquery"],t):t(e.$)}(this,function(e){"use strict";function t(e){return"%"==e[e.length-1]}function r(e){var t=e.split(" ");if(1!==t.length)return t.map(function(t){switch(e){case"center":return"50%";case"top":case"left":return"0";case"right":case"bottom":return"100%";default:return t}});switch(e){case"center":return["50%","50%"];case"top":return["50%","0"];case"bottom":return["50%","100%"];case"left":return["0","50%"];case"right":return["100%","50%"];default:return[e,"50%"]}}function i(e,t,r){function i(e,t){var r=s.createShader(e);if(s.shaderSource(r,t),s.compileShader(r),!s.getShaderParameter(r,s.COMPILE_STATUS))throw new Error("compile error: "+s.getShaderInfoLog(r));return r}var o={};if(o.id=s.createProgram(),s.attachShader(o.id,i(s.VERTEX_SHADER,e)),s.attachShader(o.id,i(s.FRAGMENT_SHADER,t)),s.linkProgram(o.id),!s.getProgramParameter(o.id,s.LINK_STATUS))throw new Error("link error: "+s.getProgramInfoLog(o.id));o.uniforms={},o.locations={},s.useProgram(o.id),s.enableVertexAttribArray(0);for(var n,a,u=/uniform (\w+) (\w+)/g,h=e+t;null!=(n=u.exec(h));)a=n[2],o.locations[a]=s.getUniformLocation(o.id,a);return o}function o(e,t){s.activeTexture(s.TEXTURE0+(t||0)),s.bindTexture(s.TEXTURE_2D,e)}function n(e){var t=/url\(["']?([^"']*)["']?\)/.exec(e);return null==t?null:t[1]}function a(e){return e.match(/^data:/)}var s,u=(e=e&&"default"in e?e.default:e)(window),h=function(){function e(e,t,i){var o="OES_texture_"+e,n=o+"_linear",a=n in r,s=[o];return a&&s.push(n),{type:t,arrayType:i,linearSupport:a,extensions:s}}var t=document.createElement("canvas");if(!(s=t.getContext("webgl")||t.getContext("experimental-webgl")))return null;var r={};if(["OES_texture_float","OES_texture_half_float","OES_texture_float_linear","OES_texture_half_float_linear"].forEach(function(e){var t=s.getExtension(e);t&&(r[e]=t)}),!r.OES_texture_float)return null;var i=[];i.push(e("float",s.FLOAT,Float32Array)),r.OES_texture_half_float&&i.push(e("half_float",r.OES_texture_half_float.HALF_FLOAT_OES,null));var o=s.createTexture(),n=s.createFramebuffer();s.bindFramebuffer(s.FRAMEBUFFER,n),s.bindTexture(s.TEXTURE_2D,o),s.texParameteri(s.TEXTURE_2D,s.TEXTURE_MIN_FILTER,s.NEAREST),s.texParameteri(s.TEXTURE_2D,s.TEXTURE_MAG_FILTER,s.NEAREST),s.texParameteri(s.TEXTURE_2D,s.TEXTURE_WRAP_S,s.CLAMP_TO_EDGE),s.texParameteri(s.TEXTURE_2D,s.TEXTURE_WRAP_T,s.CLAMP_TO_EDGE);for(var a=null,u=0;u<i.length;u++)if(s.texImage2D(s.TEXTURE_2D,0,s.RGBA,32,32,0,s.RGBA,i[u].type,null),s.framebufferTexture2D(s.FRAMEBUFFER,s.COLOR_ATTACHMENT0,s.TEXTURE_2D,o,0),s.checkFramebufferStatus(s.FRAMEBUFFER)===s.FRAMEBUFFER_COMPLETE){a=i[u];break}return a}(),c=function(e,t){try{return new ImageData(e,t)}catch(r){return document.createElement("canvas").getContext("2d").createImageData(e,t)}}(32,32);e("head").prepend("<style>.jquery-ripples { position: relative; z-index: 0; }</style>");var d=function(t,r){function i(){o.destroyed||(o.step(),requestAnimationFrame(i))}var o=this;this.$el=e(t),this.interactive=r.interactive,this.resolution=r.resolution,this.textureDelta=new Float32Array([1/this.resolution,1/this.resolution]),this.perturbance=r.perturbance,this.dropRadius=r.dropRadius,this.crossOrigin=r.crossOrigin,this.imageUrl=r.imageUrl;var n=document.createElement("canvas");n.width=this.$el.innerWidth(),n.height=this.$el.innerHeight(),this.canvas=n,this.$canvas=e(n),this.$canvas.css({position:"absolute",left:0,top:0,right:0,bottom:0,zIndex:-1}),this.$el.addClass("jquery-ripples").append(n),this.context=s=n.getContext("webgl")||n.getContext("experimental-webgl"),h.extensions.forEach(function(e){s.getExtension(e)}),e(window).on("resize",function(){o.updateSize()}),this.textures=[],this.framebuffers=[],this.bufferWriteIndex=0,this.bufferReadIndex=1;for(var a=h.arrayType,u=a?new a(this.resolution*this.resolution*4):null,c=0;c<2;c++){var d=s.createTexture(),f=s.createFramebuffer();s.bindFramebuffer(s.FRAMEBUFFER,f),s.bindTexture(s.TEXTURE_2D,d),s.texParameteri(s.TEXTURE_2D,s.TEXTURE_MIN_FILTER,h.linearSupport?s.LINEAR:s.NEAREST),s.texParameteri(s.TEXTURE_2D,s.TEXTURE_MAG_FILTER,h.linearSupport?s.LINEAR:s.NEAREST),s.texParameteri(s.TEXTURE_2D,s.TEXTURE_WRAP_S,s.CLAMP_TO_EDGE),s.texParameteri(s.TEXTURE_2D,s.TEXTURE_WRAP_T,s.CLAMP_TO_EDGE),s.texImage2D(s.TEXTURE_2D,0,s.RGBA,this.resolution,this.resolution,0,s.RGBA,h.type,u),s.framebufferTexture2D(s.FRAMEBUFFER,s.COLOR_ATTACHMENT0,s.TEXTURE_2D,d,0),this.textures.push(d),this.framebuffers.push(f)}this.quad=s.createBuffer(),s.bindBuffer(s.ARRAY_BUFFER,this.quad),s.bufferData(s.ARRAY_BUFFER,new Float32Array([-1,-1,1,-1,1,1,-1,1]),s.STATIC_DRAW),this.initShaders(),this.initTexture(),this.setTransparentTexture(),this.loadImage(),s.clearColor(0,0,0,0),s.blendFunc(s.SRC_ALPHA,s.ONE_MINUS_SRC_ALPHA),this.visible=!0,this.running=!0,this.inited=!0,this.destroyed=!1,this.setupPointerEvents(),requestAnimationFrame(i)};d.DEFAULTS={imageUrl:null,resolution:256,dropRadius:20,perturbance:.03,interactive:!0,crossOrigin:""},d.prototype={setupPointerEvents:function(){function e(){return r.visible&&r.running&&r.interactive}function t(t,i){e()&&r.dropAtPointer(t,r.dropRadius*(i?1.5:1),i?.14:.01)}var r=this;this.$el.on("mousemove.ripples",function(e){t(e)}).on("touchmove.ripples, touchstart.ripples",function(e){for(var r=e.originalEvent.changedTouches,i=0;i<r.length;i++)t(r[i])}).on("mousedown.ripples",function(e){t(e,!0)})},loadImage:function(){var e=this;s=this.context;var t=this.imageUrl||n(this.originalCssBackgroundImage)||n(this.$el.css("backgroundImage"));if(t!=this.imageSource)if(this.imageSource=t,this.imageSource){var r=new Image;r.onload=function(){function t(e){return 0==(e&e-1)}s=e.context;var i=t(r.width)&&t(r.height)?s.REPEAT:s.CLAMP_TO_EDGE;s.bindTexture(s.TEXTURE_2D,e.backgroundTexture),s.texParameteri(s.TEXTURE_2D,s.TEXTURE_WRAP_S,i),s.texParameteri(s.TEXTURE_2D,s.TEXTURE_WRAP_T,i),s.texImage2D(s.TEXTURE_2D,0,s.RGBA,s.RGBA,s.UNSIGNED_BYTE,r),e.backgroundWidth=r.width,e.backgroundHeight=r.height,e.hideCssBackground()},r.onerror=function(){s=e.context,e.setTransparentTexture()},r.crossOrigin=a(this.imageSource)?null:this.crossOrigin,r.src=this.imageSource}else this.setTransparentTexture()},step:function(){s=this.context,this.visible&&(this.computeTextureBoundaries(),this.running&&this.update(),this.render())},drawQuad:function(){s.bindBuffer(s.ARRAY_BUFFER,this.quad),s.vertexAttribPointer(0,2,s.FLOAT,!1,0,0),s.drawArrays(s.TRIANGLE_FAN,0,4)},render:function(){s.bindFramebuffer(s.FRAMEBUFFER,null),s.viewport(0,0,this.canvas.width,this.canvas.height),s.enable(s.BLEND),s.clear(s.COLOR_BUFFER_BIT|s.DEPTH_BUFFER_BIT),s.useProgram(this.renderProgram.id),o(this.backgroundTexture,0),o(this.textures[0],1),s.uniform1f(this.renderProgram.locations.perturbance,this.perturbance),s.uniform2fv(this.renderProgram.locations.topLeft,this.renderProgram.uniforms.topLeft),s.uniform2fv(this.renderProgram.locations.bottomRight,this.renderProgram.uniforms.bottomRight),s.uniform2fv(this.renderProgram.locations.containerRatio,this.renderProgram.uniforms.containerRatio),s.uniform1i(this.renderProgram.locations.samplerBackground,0),s.uniform1i(this.renderProgram.locations.samplerRipples,1),this.drawQuad(),s.disable(s.BLEND)},update:function(){s.viewport(0,0,this.resolution,this.resolution),s.bindFramebuffer(s.FRAMEBUFFER,this.framebuffers[this.bufferWriteIndex]),o(this.textures[this.bufferReadIndex]),s.useProgram(this.updateProgram.id),this.drawQuad(),this.swapBufferIndices()},swapBufferIndices:function(){this.bufferWriteIndex=1-this.bufferWriteIndex,this.bufferReadIndex=1-this.bufferReadIndex},computeTextureBoundaries:function(){var e,i=this.$el.css("background-size"),o=this.$el.css("background-attachment"),n=r(this.$el.css("background-position"));if("fixed"==o?((e={left:window.pageXOffset,top:window.pageYOffset}).width=u.width(),e.height=u.height()):((e=this.$el.offset()).width=this.$el.innerWidth(),e.height=this.$el.innerHeight()),"cover"==i)var a=Math.max(e.width/this.backgroundWidth,e.height/this.backgroundHeight),s=this.backgroundWidth*a,h=this.backgroundHeight*a;else if("contain"==i)var a=Math.min(e.width/this.backgroundWidth,e.height/this.backgroundHeight),s=this.backgroundWidth*a,h=this.backgroundHeight*a;else{var s=(i=i.split(" "))[0]||"",h=i[1]||s;t(s)?s=e.width*parseFloat(s)/100:"auto"!=s&&(s=parseFloat(s)),t(h)?h=e.height*parseFloat(h)/100:"auto"!=h&&(h=parseFloat(h)),"auto"==s&&"auto"==h?(s=this.backgroundWidth,h=this.backgroundHeight):("auto"==s&&(s=this.backgroundWidth*(h/this.backgroundHeight)),"auto"==h&&(h=this.backgroundHeight*(s/this.backgroundWidth)))}var c=n[0],d=n[1];c=t(c)?e.left+(e.width-s)*parseFloat(c)/100:e.left+parseFloat(c),d=t(d)?e.top+(e.height-h)*parseFloat(d)/100:e.top+parseFloat(d);var f=this.$el.offset();this.renderProgram.uniforms.topLeft=new Float32Array([(f.left-c)/s,(f.top-d)/h]),this.renderProgram.uniforms.bottomRight=new Float32Array([this.renderProgram.uniforms.topLeft[0]+this.$el.innerWidth()/s,this.renderProgram.uniforms.topLeft[1]+this.$el.innerHeight()/h]);var l=Math.max(this.canvas.width,this.canvas.height);this.renderProgram.uniforms.containerRatio=new Float32Array([this.canvas.width/l,this.canvas.height/l])},initShaders:function(){var e=["attribute vec2 vertex;","varying vec2 coord;","void main() {","coord = vertex * 0.5 + 0.5;","gl_Position = vec4(vertex, 0.0, 1.0);","}"].join("\n");this.dropProgram=i(e,["precision highp float;","const float PI = 3.141592653589793;","uniform sampler2D texture;","uniform vec2 center;","uniform float radius;","uniform float strength;","varying vec2 coord;","void main() {","vec4 info = texture2D(texture, coord);","float drop = max(0.0, 1.0 - length(center * 0.5 + 0.5 - coord) / radius);","drop = 0.5 - cos(drop * PI) * 0.5;","info.r += drop * strength;","gl_FragColor = info;","}"].join("\n")),this.updateProgram=i(e,["precision highp float;","uniform sampler2D texture;","uniform vec2 delta;","varying vec2 coord;","void main() {","vec4 info = texture2D(texture, coord);","vec2 dx = vec2(delta.x, 0.0);","vec2 dy = vec2(0.0, delta.y);","float average = (","texture2D(texture, coord - dx).r +","texture2D(texture, coord - dy).r +","texture2D(texture, coord + dx).r +","texture2D(texture, coord + dy).r",") * 0.25;","info.g += (average - info.r) * 2.0;","info.g *= 0.995;","info.r += info.g;","gl_FragColor = info;","}"].join("\n")),s.uniform2fv(this.updateProgram.locations.delta,this.textureDelta),this.renderProgram=i(["precision highp float;","attribute vec2 vertex;","uniform vec2 topLeft;","uniform vec2 bottomRight;","uniform vec2 containerRatio;","varying vec2 ripplesCoord;","varying vec2 backgroundCoord;","void main() {","backgroundCoord = mix(topLeft, bottomRight, vertex * 0.5 + 0.5);","backgroundCoord.y = 1.0 - backgroundCoord.y;","ripplesCoord = vec2(vertex.x, -vertex.y) * containerRatio * 0.5 + 0.5;","gl_Position = vec4(vertex.x, -vertex.y, 0.0, 1.0);","}"].join("\n"),["precision highp float;","uniform sampler2D samplerBackground;","uniform sampler2D samplerRipples;","uniform vec2 delta;","uniform float perturbance;","varying vec2 ripplesCoord;","varying vec2 backgroundCoord;","void main() {","float height = texture2D(samplerRipples, ripplesCoord).r;","float heightX = texture2D(samplerRipples, vec2(ripplesCoord.x + delta.x, ripplesCoord.y)).r;","float heightY = texture2D(samplerRipples, vec2(ripplesCoord.x, ripplesCoord.y + delta.y)).r;","vec3 dx = vec3(delta.x, heightX - height, 0.0);","vec3 dy = vec3(0.0, heightY - height, delta.y);","vec2 offset = -normalize(cross(dy, dx)).xz;","float specular = pow(max(0.0, dot(offset, normalize(vec2(-0.6, 1.0)))), 4.0);","gl_FragColor = texture2D(samplerBackground, backgroundCoord + offset * perturbance) + specular;","}"].join("\n")),s.uniform2fv(this.renderProgram.locations.delta,this.textureDelta)},initTexture:function(){this.backgroundTexture=s.createTexture(),s.bindTexture(s.TEXTURE_2D,this.backgroundTexture),s.pixelStorei(s.UNPACK_FLIP_Y_WEBGL,1),s.texParameteri(s.TEXTURE_2D,s.TEXTURE_MAG_FILTER,s.LINEAR),s.texParameteri(s.TEXTURE_2D,s.TEXTURE_MIN_FILTER,s.LINEAR)},setTransparentTexture:function(){s.bindTexture(s.TEXTURE_2D,this.backgroundTexture),s.texImage2D(s.TEXTURE_2D,0,s.RGBA,s.RGBA,s.UNSIGNED_BYTE,c)},hideCssBackground:function(){var e=this.$el[0].style.backgroundImage;"none"!=e&&(this.originalInlineCss=e,this.originalCssBackgroundImage=this.$el.css("backgroundImage"),this.$el.css("backgroundImage","none"))},restoreCssBackground:function(){this.$el.css("backgroundImage",this.originalInlineCss||"")},dropAtPointer:function(e,t,r){var i=parseInt(this.$el.css("border-left-width"))||0,o=parseInt(this.$el.css("border-top-width"))||0;this.drop(e.pageX-this.$el.offset().left-i,e.pageY-this.$el.offset().top-o,t,r)},drop:function(e,t,r,i){s=this.context;var n=this.$el.innerWidth(),a=this.$el.innerHeight(),u=Math.max(n,a);r/=u;var h=new Float32Array([(2*e-n)/u,(a-2*t)/u]);s.viewport(0,0,this.resolution,this.resolution),s.bindFramebuffer(s.FRAMEBUFFER,this.framebuffers[this.bufferWriteIndex]),o(this.textures[this.bufferReadIndex]),s.useProgram(this.dropProgram.id),s.uniform2fv(this.dropProgram.locations.center,h),s.uniform1f(this.dropProgram.locations.radius,r),s.uniform1f(this.dropProgram.locations.strength,i),this.drawQuad(),this.swapBufferIndices()},updateSize:function(){var e=this.$el.innerWidth(),t=this.$el.innerHeight();e==this.canvas.width&&t==this.canvas.height||(this.canvas.width=e,this.canvas.height=t)},destroy:function(){this.$el.off(".ripples").removeClass("jquery-ripples").removeData("ripples"),this.$canvas.remove(),this.restoreCssBackground(),this.destroyed=!0},show:function(){this.visible=!0,this.$canvas.show(),this.hideCssBackground()},hide:function(){this.visible=!1,this.$canvas.hide(),this.restoreCssBackground()},pause:function(){this.running=!1},play:function(){this.running=!0},set:function(e,t){switch(e){case"dropRadius":case"perturbance":case"interactive":case"crossOrigin":this[e]=t;break;case"imageUrl":this.imageUrl=t,this.loadImage()}}};var f=e.fn.ripples;e.fn.ripples=function(t){if(!h)throw new Error("Your browser does not support WebGL, the OES_texture_float extension or rendering to floating point textures.");var r=arguments.length>1?Array.prototype.slice.call(arguments,1):void 0;return this.each(function(){var i=e(this),o=i.data("ripples"),n=e.extend({},d.DEFAULTS,i.data(),"object"==typeof t&&t);(o||"string"!=typeof t)&&(o?"string"==typeof t&&d.prototype[t].apply(o,r):i.data("ripples",o=new d(this,n)))})},e.fn.ripples.Constructor=d,e.fn.ripples.noConflict=function(){return e.fn.ripples=f,this}});
 

/*!
 * The Final Countdown for jQuery v2.2.0 (http://hilios.github.io/jQuery.countdown/)
 * Copyright (c) 2016 Edson Hilios
 * 
 * Permission is hereby granted, free of charge, to any person obtaining a copy of
 * this software and associated documentation files (the "Software"), to deal in
 * the Software without restriction, including without limitation the rights to
 * use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of
 * the Software, and to permit persons to whom the Software is furnished to do so,
 * subject to the following conditions:
 * 
 * The above copyright notice and this permission notice shall be included in all
 * copies or substantial portions of the Software.
 * 
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS
 * FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR
 * COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER
 * IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN
 * CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
 */
(function(factory) {
    "use strict";
    if (typeof define === "function" && define.amd) {
        define([ "jquery" ], factory);
    } else {
        factory(jQuery);
    }
})(function($) {
    "use strict";
    var instances = [], matchers = [], defaultOptions = {
        precision: 100,
        elapse: false,
        defer: false
    };
    matchers.push(/^[0-9]*$/.source);
    matchers.push(/([0-9]{1,2}\/){2}[0-9]{4}( [0-9]{1,2}(:[0-9]{2}){2})?/.source);
    matchers.push(/[0-9]{4}([\/\-][0-9]{1,2}){2}( [0-9]{1,2}(:[0-9]{2}){2})?/.source);
    matchers = new RegExp(matchers.join("|"));
    function parseDateString(dateString) {
        if (dateString instanceof Date) {
            return dateString;
        }
        if (String(dateString).match(matchers)) {
            if (String(dateString).match(/^[0-9]*$/)) {
                dateString = Number(dateString);
            }
            if (String(dateString).match(/\-/)) {
                dateString = String(dateString).replace(/\-/g, "/");
            }
            return new Date(dateString);
        } else {
            throw new Error("Couldn't cast `" + dateString + "` to a date object.");
        }
    }
    var DIRECTIVE_KEY_MAP = {
        Y: "years",
        m: "months",
        n: "daysToMonth",
        d: "daysToWeek",
        w: "weeks",
        W: "weeksToMonth",
        H: "hours",
        M: "minutes",
        S: "seconds",
        D: "totalDays",
        I: "totalHours",
        N: "totalMinutes",
        T: "totalSeconds"
    };
    function escapedRegExp(str) {
        var sanitize = str.toString().replace(/([.?*+^$[\]\\(){}|-])/g, "\\$1");
        return new RegExp(sanitize);
    }
    function strftime(offsetObject) {
        return function(format) {
            var directives = format.match(/%(-|!)?[A-Z]{1}(:[^;]+;)?/gi);
            if (directives) {
                for (var i = 0, len = directives.length; i < len; ++i) {
                    var directive = directives[i].match(/%(-|!)?([a-zA-Z]{1})(:[^;]+;)?/), regexp = escapedRegExp(directive[0]), modifier = directive[1] || "", plural = directive[3] || "", value = null;
                    directive = directive[2];
                    if (DIRECTIVE_KEY_MAP.hasOwnProperty(directive)) {
                        value = DIRECTIVE_KEY_MAP[directive];
                        value = Number(offsetObject[value]);
                    }
                    if (value !== null) {
                        if (modifier === "!") {
                            value = pluralize(plural, value);
                        }
                        if (modifier === "") {
                            if (value < 10) {
                                value = "0" + value.toString();
                            }
                        }
                        format = format.replace(regexp, value.toString());
                    }
                }
            }
            format = format.replace(/%%/, "%");
            return format;
        };
    }
    function pluralize(format, count) {
        var plural = "s", singular = "";
        if (format) {
            format = format.replace(/(:|;|\s)/gi, "").split(/\,/);
            if (format.length === 1) {
                plural = format[0];
            } else {
                singular = format[0];
                plural = format[1];
            }
        }
        if (Math.abs(count) > 1) {
            return plural;
        } else {
            return singular;
        }
    }
    var Countdown = function(el, finalDate, options) {
        this.el = el;
        this.$el = $(el);
        this.interval = null;
        this.offset = {};
        this.options = $.extend({}, defaultOptions);
        this.instanceNumber = instances.length;
        instances.push(this);
        this.$el.data("countdown-instance", this.instanceNumber);
        if (options) {
            if (typeof options === "function") {
                this.$el.on("update.countdown", options);
                this.$el.on("stoped.countdown", options);
                this.$el.on("finish.countdown", options);
            } else {
                this.options = $.extend({}, defaultOptions, options);
            }
        }
        this.setFinalDate(finalDate);
        if (this.options.defer === false) {
            this.start();
        }
    };
    $.extend(Countdown.prototype, {
        start: function() {
            if (this.interval !== null) {
                clearInterval(this.interval);
            }
            var self = this;
            this.update();
            this.interval = setInterval(function() {
                self.update.call(self);
            }, this.options.precision);
        },
        stop: function() {
            clearInterval(this.interval);
            this.interval = null;
            this.dispatchEvent("stoped");
        },
        toggle: function() {
            if (this.interval) {
                this.stop();
            } else {
                this.start();
            }
        },
        pause: function() {
            this.stop();
        },
        resume: function() {
            this.start();
        },
        remove: function() {
            this.stop.call(this);
            instances[this.instanceNumber] = null;
            delete this.$el.data().countdownInstance;
        },
        setFinalDate: function(value) {
            this.finalDate = parseDateString(value);
        },
        update: function() {
            if (this.$el.closest("html").length === 0) {
                this.remove();
                return;
            }
            var hasEventsAttached = $._data(this.el, "events") !== undefined, now = new Date(), newTotalSecsLeft;
            newTotalSecsLeft = this.finalDate.getTime() - now.getTime();
            newTotalSecsLeft = Math.ceil(newTotalSecsLeft / 1e3);
            newTotalSecsLeft = !this.options.elapse && newTotalSecsLeft < 0 ? 0 : Math.abs(newTotalSecsLeft);
            if (this.totalSecsLeft === newTotalSecsLeft || !hasEventsAttached) {
                return;
            } else {
                this.totalSecsLeft = newTotalSecsLeft;
            }
            this.elapsed = now >= this.finalDate;
            this.offset = {
                seconds: this.totalSecsLeft % 60,
                minutes: Math.floor(this.totalSecsLeft / 60) % 60,
                hours: Math.floor(this.totalSecsLeft / 60 / 60) % 24,
                days: Math.floor(this.totalSecsLeft / 60 / 60 / 24) % 7,
                daysToWeek: Math.floor(this.totalSecsLeft / 60 / 60 / 24) % 7,
                daysToMonth: Math.floor(this.totalSecsLeft / 60 / 60 / 24 % 30.4368),
                weeks: Math.floor(this.totalSecsLeft / 60 / 60 / 24 / 7),
                weeksToMonth: Math.floor(this.totalSecsLeft / 60 / 60 / 24 / 7) % 4,
                months: Math.floor(this.totalSecsLeft / 60 / 60 / 24 / 30.4368),
                years: Math.abs(this.finalDate.getFullYear() - now.getFullYear()),
                totalDays: Math.floor(this.totalSecsLeft / 60 / 60 / 24),
                totalHours: Math.floor(this.totalSecsLeft / 60 / 60),
                totalMinutes: Math.floor(this.totalSecsLeft / 60),
                totalSeconds: this.totalSecsLeft
            };
            if (!this.options.elapse && this.totalSecsLeft === 0) {
                this.stop();
                this.dispatchEvent("finish");
            } else {
                this.dispatchEvent("update");
            }
        },
        dispatchEvent: function(eventName) {
            var event = $.Event(eventName + ".countdown");
            event.finalDate = this.finalDate;
            event.elapsed = this.elapsed;
            event.offset = $.extend({}, this.offset);
            event.strftime = strftime(this.offset);
            this.$el.trigger(event);
        }
    });
    $.fn.countdown = function() {
        var argumentsArray = Array.prototype.slice.call(arguments, 0);
        return this.each(function() {
            var instanceNumber = $(this).data("countdown-instance");
            if (instanceNumber !== undefined) {
                var instance = instances[instanceNumber], method = argumentsArray[0];
                if (Countdown.prototype.hasOwnProperty(method)) {
                    instance[method].apply(instance, argumentsArray.slice(1));
                } else if (String(method).match(/^[$A-Z_][0-9A-Z_$]*$/i) === null) {
                    instance.setFinalDate.call(instance, method);
                    instance.start();
                } else {
                    $.error("Method %s does not exist on jQuery.countdown".replace(/\%s/gi, method));
                }
            } else {
                new Countdown(this, argumentsArray[0], argumentsArray[1]);
            }
        });
    };
}); 
 
