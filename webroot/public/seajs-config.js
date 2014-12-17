/*map start*/
//seajs.production = true;
if (seajs.production) {
    seajs.config({
        map: [
        ]
    });
}
/*map end*/
seajs.config({
    alias: {
        "sea": "seajs/seajs/2.2.1/sea",
        "seajs-log": "seajs/seajs-log/1.0.1/seajs-log",
        "seajs-style": "seajs/seajs-style/1.0.2/seajs-style",
        "seajs-health": "seajs/seajs-health/0.1.1/seajs-health"
    },
    preload: [
    ]
});
if(seajs.admin){
    // 后台不需要此配置
    seajs.production = false;
    seajs.config({map: []});
}

var asRequire = {
    async: function (require) {
        if (typeof(arguments[1]) == 'string') {
            // 只有 js 开头的才需要区分生产，开发环境
            if (arguments[1].indexOf('js/') == 0) {
                arguments[1] = (seajs.production ? '' : asapp.config.res + "/src/") + arguments[1];
            }
        } else {
            for (var key in arguments[1]) {
                // 只有 js 开头的才需要区分生产，开发环境
                if (arguments[1][key].indexOf('js/') == 0) {
                    arguments[1][key] = (seajs.production ? '' : asapp.config.res + "/src/") + arguments[1][key];
                }
            }
        }
        require.async.apply(
            this, Array.prototype.slice.call(arguments, 1));
    },
    require: function (require, path) {
        if( seajs.production ){
            path = path.replace("js/", "./");
        }else{
            path = asapp.config.res + "/src/" + path;
        }

        return require(path);
    }
}

if (typeof(window.console) == 'undefined' || typeof(window.console.log) == 'undefined') {
    window.console = {
        log: function (message) {
            // debug
            // alert(message)
        },
        warn: function (message) {
            // debug
            // alert(message)
        },
        error: function (message) {
            // debug
            // alert(message)
        }
    }
}
