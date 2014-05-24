var isMobile = {
    Android: function() {
        return navigator.userAgent.match(/Android/i);
    },
    BlackBerry: function() {
        return navigator.userAgent.match(/BlackBerry/i);
    },
    iOS: function() {
        return navigator.userAgent.match(/iPhone|iPad|iPod/i);
    },
    Opera: function() {
        return navigator.userAgent.match(/Opera Mini/i);
    },
    Windows: function() {
        return navigator.userAgent.match(/IEMobile/i);
    },
    any: function() {
        return (isMobile.Android() || isMobile.BlackBerry() || isMobile.iOS() || isMobile.Opera() || isMobile.Windows());
    },
    deviseName : function(){
        if (this.Android()) {
            return "Android";
        };
        if (this.BlackBerry()) {
            return "BlackBerry";
        };
        if (this.iOS()) {
            return "iOS";
        };
        if (this.Opera()) {
            return "Using Opera";
        };
        if (this.Windows()) {
            return "Windows";
        };
        return "Unidentified devise"
    }
};