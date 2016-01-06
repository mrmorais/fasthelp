var page = "index";
var target_page = null;
/* ========================================================================
 * FastHelp #Adaptável ao Android 4.0+
 * ========================================================================*/
$(function() {
	if (!window.CustomEvent) {
		(function() {
			function CustomEvent(event, params) {
				params = params || {
					bubbles: false,
					cancelable: false,
					detail: undefined
				};
				var evt = document.createEvent('CustomEvent');
				evt.initCustomEvent(event, params.bubbles, params.cancelable, params.detail);
				return evt;
			};

			CustomEvent.prototype = window.Event.prototype;

			window.CustomEvent = CustomEvent;
		})();
	}
	throwPush("index", "slide-in");
});
/* ========================================================================
 * FastHelp #BackKey event
 * ========================================================================*/
var onBackKeyDown = function() {
	switch(getCurrentTarget()) {
		case "home":
			logout();
			break;
		case "criar_conta":
			throwPush("index", "slide-out");
			break;
		case "orgaos":
			throwPush("home", "slide-out");
			break;
	}
};
/* ========================================================================
 * FastHelp #Pusher blocks
 * ========================================================================*/
var catchPush = function(e) {
	switch (target_page) {
		case "two":
			console.log("Do two");
			break;
		case "index":
			console.log("Do index");
			break;
		case "home":
			home();
			break;
		case "criar_conta":
			console.log("Do criar_conta");
			break;
		case "orgaos":
			DoOrgaos();
			break;
		case "status":
			DoStatus();
			break;
		case "chamado":
			DoChamado();
			break;
	}
	page = target_page;
};
var throwPush = function(target, transition) {
	target_page = target;
	PUSH({url: target+".html", transition: transition});
};
var sairDeChamado = function() {
	clearInterval(thLNM);
	throwPush("home", "slide-out");
}
