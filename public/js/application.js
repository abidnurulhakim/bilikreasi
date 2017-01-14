/* Modernizr 2.8.3 (Custom Build) | MIT & BSD
 * Build: http://modernizr.com/download/#-fontface-backgroundsize-borderimage-borderradius-boxshadow-flexbox-hsla-multiplebgs-opacity-textshadow-cssanimations-csscolumns-cssgradients-cssreflections-csstransforms-csstransforms3d-csstransitions-applicationcache-canvas-canvastext-draganddrop-hashchange-history-audio-video-indexeddb-input-inputtypes-localstorage-postmessage-sessionstorage-websockets-websqldatabase-webworkers-geolocation-inlinesvg-svg-svgclippaths-touch-webgl-shiv-mq-cssclasses-addtest-prefixed-teststyles-testprop-testallprops-hasevent-prefixes-domprefixes-css_calc-css_lastchild-css_mediaqueries-css_positionsticky-img_webp-load
 */
;



window.Modernizr = (function( window, document, undefined ) {

    var version = '2.8.3',

    Modernizr = {},

    enableClasses = true,

    docElement = document.documentElement,

    mod = 'modernizr',
    modElem = document.createElement(mod),
    mStyle = modElem.style,

    inputElem  = document.createElement('input')  ,

    smile = ':)',

    toString = {}.toString,

    prefixes = ' -webkit- -moz- -o- -ms- '.split(' '),



    omPrefixes = 'Webkit Moz O ms',

    cssomPrefixes = omPrefixes.split(' '),

    domPrefixes = omPrefixes.toLowerCase().split(' '),

    ns = {'svg': 'http://www.w3.org/2000/svg'},

    tests = {},
    inputs = {},
    attrs = {},

    classes = [],

    slice = classes.slice,

    featureName, 


    injectElementWithStyles = function( rule, callback, nodes, testnames ) {

      var style, ret, node, docOverflow,
          div = document.createElement('div'),
                body = document.body,
                fakeBody = body || document.createElement('body');

      if ( parseInt(nodes, 10) ) {
                      while ( nodes-- ) {
              node = document.createElement('div');
              node.id = testnames ? testnames[nodes] : mod + (nodes + 1);
              div.appendChild(node);
          }
      }

                style = ['&#173;','<style id="s', mod, '">', rule, '</style>'].join('');
      div.id = mod;
          (body ? div : fakeBody).innerHTML += style;
      fakeBody.appendChild(div);
      if ( !body ) {
                fakeBody.style.background = '';
                fakeBody.style.overflow = 'hidden';
          docOverflow = docElement.style.overflow;
          docElement.style.overflow = 'hidden';
          docElement.appendChild(fakeBody);
      }

      ret = callback(div, rule);
        if ( !body ) {
          fakeBody.parentNode.removeChild(fakeBody);
          docElement.style.overflow = docOverflow;
      } else {
          div.parentNode.removeChild(div);
      }

      return !!ret;

    },

    testMediaQuery = function( mq ) {

      var matchMedia = window.matchMedia || window.msMatchMedia;
      if ( matchMedia ) {
        return matchMedia(mq) && matchMedia(mq).matches || false;
      }

      var bool;

      injectElementWithStyles('@media ' + mq + ' { #' + mod + ' { position: absolute; } }', function( node ) {
        bool = (window.getComputedStyle ?
                  getComputedStyle(node, null) :
                  node.currentStyle)['position'] == 'absolute';
      });

      return bool;

     },
 

    isEventSupported = (function() {

      var TAGNAMES = {
        'select': 'input', 'change': 'input',
        'submit': 'form', 'reset': 'form',
        'error': 'img', 'load': 'img', 'abort': 'img'
      };

      function isEventSupported( eventName, element ) {

        element = element || document.createElement(TAGNAMES[eventName] || 'div');
        eventName = 'on' + eventName;

            var isSupported = eventName in element;

        if ( !isSupported ) {
                if ( !element.setAttribute ) {
            element = document.createElement('div');
          }
          if ( element.setAttribute && element.removeAttribute ) {
            element.setAttribute(eventName, '');
            isSupported = is(element[eventName], 'function');

                    if ( !is(element[eventName], 'undefined') ) {
              element[eventName] = undefined;
            }
            element.removeAttribute(eventName);
          }
        }

        element = null;
        return isSupported;
      }
      return isEventSupported;
    })(),


    _hasOwnProperty = ({}).hasOwnProperty, hasOwnProp;

    if ( !is(_hasOwnProperty, 'undefined') && !is(_hasOwnProperty.call, 'undefined') ) {
      hasOwnProp = function (object, property) {
        return _hasOwnProperty.call(object, property);
      };
    }
    else {
      hasOwnProp = function (object, property) { 
        return ((property in object) && is(object.constructor.prototype[property], 'undefined'));
      };
    }


    if (!Function.prototype.bind) {
      Function.prototype.bind = function bind(that) {

        var target = this;

        if (typeof target != "function") {
            throw new TypeError();
        }

        var args = slice.call(arguments, 1),
            bound = function () {

            if (this instanceof bound) {

              var F = function(){};
              F.prototype = target.prototype;
              var self = new F();

              var result = target.apply(
                  self,
                  args.concat(slice.call(arguments))
              );
              if (Object(result) === result) {
                  return result;
              }
              return self;

            } else {

              return target.apply(
                  that,
                  args.concat(slice.call(arguments))
              );

            }

        };

        return bound;
      };
    }

    function setCss( str ) {
        mStyle.cssText = str;
    }

    function setCssAll( str1, str2 ) {
        return setCss(prefixes.join(str1 + ';') + ( str2 || '' ));
    }

    function is( obj, type ) {
        return typeof obj === type;
    }

    function contains( str, substr ) {
        return !!~('' + str).indexOf(substr);
    }

    function testProps( props, prefixed ) {
        for ( var i in props ) {
            var prop = props[i];
            if ( !contains(prop, "-") && mStyle[prop] !== undefined ) {
                return prefixed == 'pfx' ? prop : true;
            }
        }
        return false;
    }

    function testDOMProps( props, obj, elem ) {
        for ( var i in props ) {
            var item = obj[props[i]];
            if ( item !== undefined) {

                            if (elem === false) return props[i];

                            if (is(item, 'function')){
                                return item.bind(elem || obj);
                }

                            return item;
            }
        }
        return false;
    }

    function testPropsAll( prop, prefixed, elem ) {

        var ucProp  = prop.charAt(0).toUpperCase() + prop.slice(1),
            props   = (prop + ' ' + cssomPrefixes.join(ucProp + ' ') + ucProp).split(' ');

            if(is(prefixed, "string") || is(prefixed, "undefined")) {
          return testProps(props, prefixed);

            } else {
          props = (prop + ' ' + (domPrefixes).join(ucProp + ' ') + ucProp).split(' ');
          return testDOMProps(props, prefixed, elem);
        }
    }    tests['flexbox'] = function() {
      return testPropsAll('flexWrap');
    };    tests['canvas'] = function() {
        var elem = document.createElement('canvas');
        return !!(elem.getContext && elem.getContext('2d'));
    };

    tests['canvastext'] = function() {
        return !!(Modernizr['canvas'] && is(document.createElement('canvas').getContext('2d').fillText, 'function'));
    };



    tests['webgl'] = function() {
        return !!window.WebGLRenderingContext;
    };


    tests['touch'] = function() {
        var bool;

        if(('ontouchstart' in window) || window.DocumentTouch && document instanceof DocumentTouch) {
          bool = true;
        } else {
          injectElementWithStyles(['@media (',prefixes.join('touch-enabled),('),mod,')','{#modernizr{top:9px;position:absolute}}'].join(''), function( node ) {
            bool = node.offsetTop === 9;
          });
        }

        return bool;
    };



    tests['geolocation'] = function() {
        return 'geolocation' in navigator;
    };


    tests['postmessage'] = function() {
      return !!window.postMessage;
    };


    tests['websqldatabase'] = function() {
      return !!window.openDatabase;
    };

    tests['indexedDB'] = function() {
      return !!testPropsAll("indexedDB", window);
    };

    tests['hashchange'] = function() {
      return isEventSupported('hashchange', window) && (document.documentMode === undefined || document.documentMode > 7);
    };

    tests['history'] = function() {
      return !!(window.history && history.pushState);
    };

    tests['draganddrop'] = function() {
        var div = document.createElement('div');
        return ('draggable' in div) || ('ondragstart' in div && 'ondrop' in div);
    };

    tests['websockets'] = function() {
        return 'WebSocket' in window || 'MozWebSocket' in window;
    };



    tests['hsla'] = function() {
            setCss('background-color:hsla(120,40%,100%,.5)');

        return contains(mStyle.backgroundColor, 'rgba') || contains(mStyle.backgroundColor, 'hsla');
    };

    tests['multiplebgs'] = function() {
                setCss('background:url(https://),url(https://),red url(https://)');

            return (/(url\s*\(.*?){3}/).test(mStyle.background);
    };    tests['backgroundsize'] = function() {
        return testPropsAll('backgroundSize');
    };

    tests['borderimage'] = function() {
        return testPropsAll('borderImage');
    };



    tests['borderradius'] = function() {
        return testPropsAll('borderRadius');
    };

    tests['boxshadow'] = function() {
        return testPropsAll('boxShadow');
    };

    tests['textshadow'] = function() {
        return document.createElement('div').style.textShadow === '';
    };


    tests['opacity'] = function() {
                setCssAll('opacity:.55');

                    return (/^0.55$/).test(mStyle.opacity);
    };


    tests['cssanimations'] = function() {
        return testPropsAll('animationName');
    };


    tests['csscolumns'] = function() {
        return testPropsAll('columnCount');
    };


    tests['cssgradients'] = function() {
        var str1 = 'background-image:',
            str2 = 'gradient(linear,left top,right bottom,from(#9f9),to(white));',
            str3 = 'linear-gradient(left top,#9f9, white);';

        setCss(
                       (str1 + '-webkit- '.split(' ').join(str2 + str1) +
                       prefixes.join(str3 + str1)).slice(0, -str1.length)
        );

        return contains(mStyle.backgroundImage, 'gradient');
    };


    tests['cssreflections'] = function() {
        return testPropsAll('boxReflect');
    };


    tests['csstransforms'] = function() {
        return !!testPropsAll('transform');
    };


    tests['csstransforms3d'] = function() {

        var ret = !!testPropsAll('perspective');

                        if ( ret && 'webkitPerspective' in docElement.style ) {

                      injectElementWithStyles('@media (transform-3d),(-webkit-transform-3d){#modernizr{left:9px;position:absolute;height:3px;}}', function( node, rule ) {
            ret = node.offsetLeft === 9 && node.offsetHeight === 3;
          });
        }
        return ret;
    };


    tests['csstransitions'] = function() {
        return testPropsAll('transition');
    };



    tests['fontface'] = function() {
        var bool;

        injectElementWithStyles('@font-face {font-family:"font";src:url("https://")}', function( node, rule ) {
          var style = document.getElementById('smodernizr'),
              sheet = style.sheet || style.styleSheet,
              cssText = sheet ? (sheet.cssRules && sheet.cssRules[0] ? sheet.cssRules[0].cssText : sheet.cssText || '') : '';

          bool = /src/i.test(cssText) && cssText.indexOf(rule.split(' ')[0]) === 0;
        });

        return bool;
    };

    tests['video'] = function() {
        var elem = document.createElement('video'),
            bool = false;

            try {
            if ( bool = !!elem.canPlayType ) {
                bool      = new Boolean(bool);
                bool.ogg  = elem.canPlayType('video/ogg; codecs="theora"')      .replace(/^no$/,'');

                            bool.h264 = elem.canPlayType('video/mp4; codecs="avc1.42E01E"') .replace(/^no$/,'');

                bool.webm = elem.canPlayType('video/webm; codecs="vp8, vorbis"').replace(/^no$/,'');
            }

        } catch(e) { }

        return bool;
    };

    tests['audio'] = function() {
        var elem = document.createElement('audio'),
            bool = false;

        try {
            if ( bool = !!elem.canPlayType ) {
                bool      = new Boolean(bool);
                bool.ogg  = elem.canPlayType('audio/ogg; codecs="vorbis"').replace(/^no$/,'');
                bool.mp3  = elem.canPlayType('audio/mpeg;')               .replace(/^no$/,'');

                                                    bool.wav  = elem.canPlayType('audio/wav; codecs="1"')     .replace(/^no$/,'');
                bool.m4a  = ( elem.canPlayType('audio/x-m4a;')            ||
                              elem.canPlayType('audio/aac;'))             .replace(/^no$/,'');
            }
        } catch(e) { }

        return bool;
    };


    tests['localstorage'] = function() {
        try {
            localStorage.setItem(mod, mod);
            localStorage.removeItem(mod);
            return true;
        } catch(e) {
            return false;
        }
    };

    tests['sessionstorage'] = function() {
        try {
            sessionStorage.setItem(mod, mod);
            sessionStorage.removeItem(mod);
            return true;
        } catch(e) {
            return false;
        }
    };


    tests['webworkers'] = function() {
        return !!window.Worker;
    };


    tests['applicationcache'] = function() {
        return !!window.applicationCache;
    };


    tests['svg'] = function() {
        return !!document.createElementNS && !!document.createElementNS(ns.svg, 'svg').createSVGRect;
    };

    tests['inlinesvg'] = function() {
      var div = document.createElement('div');
      div.innerHTML = '<svg/>';
      return (div.firstChild && div.firstChild.namespaceURI) == ns.svg;
    };



    tests['svgclippaths'] = function() {
        return !!document.createElementNS && /SVGClipPath/.test(toString.call(document.createElementNS(ns.svg, 'clipPath')));
    };

    function webforms() {
                                            Modernizr['input'] = (function( props ) {
            for ( var i = 0, len = props.length; i < len; i++ ) {
                attrs[ props[i] ] = !!(props[i] in inputElem);
            }
            if (attrs.list){
                                  attrs.list = !!(document.createElement('datalist') && window.HTMLDataListElement);
            }
            return attrs;
        })('autocomplete autofocus list placeholder max min multiple pattern required step'.split(' '));
                            Modernizr['inputtypes'] = (function(props) {

            for ( var i = 0, bool, inputElemType, defaultView, len = props.length; i < len; i++ ) {

                inputElem.setAttribute('type', inputElemType = props[i]);
                bool = inputElem.type !== 'text';

                                                    if ( bool ) {

                    inputElem.value         = smile;
                    inputElem.style.cssText = 'position:absolute;visibility:hidden;';

                    if ( /^range$/.test(inputElemType) && inputElem.style.WebkitAppearance !== undefined ) {

                      docElement.appendChild(inputElem);
                      defaultView = document.defaultView;

                                        bool =  defaultView.getComputedStyle &&
                              defaultView.getComputedStyle(inputElem, null).WebkitAppearance !== 'textfield' &&
                                                                                  (inputElem.offsetHeight !== 0);

                      docElement.removeChild(inputElem);

                    } else if ( /^(search|tel)$/.test(inputElemType) ){
                                                                                    } else if ( /^(url|email)$/.test(inputElemType) ) {
                                        bool = inputElem.checkValidity && inputElem.checkValidity() === false;

                    } else {
                                        bool = inputElem.value != smile;
                    }
                }

                inputs[ props[i] ] = !!bool;
            }
            return inputs;
        })('search tel url email datetime date month week time datetime-local number range color'.split(' '));
        }
    for ( var feature in tests ) {
        if ( hasOwnProp(tests, feature) ) {
                                    featureName  = feature.toLowerCase();
            Modernizr[featureName] = tests[feature]();

            classes.push((Modernizr[featureName] ? '' : 'no-') + featureName);
        }
    }

    Modernizr.input || webforms();


     Modernizr.addTest = function ( feature, test ) {
       if ( typeof feature == 'object' ) {
         for ( var key in feature ) {
           if ( hasOwnProp( feature, key ) ) {
             Modernizr.addTest( key, feature[ key ] );
           }
         }
       } else {

         feature = feature.toLowerCase();

         if ( Modernizr[feature] !== undefined ) {
                                              return Modernizr;
         }

         test = typeof test == 'function' ? test() : test;

         if (typeof enableClasses !== "undefined" && enableClasses) {
           docElement.className += ' ' + (test ? '' : 'no-') + feature;
         }
         Modernizr[feature] = test;

       }

       return Modernizr; 
     };


    setCss('');
    modElem = inputElem = null;

    ;(function(window, document) {
                var version = '3.7.0';

            var options = window.html5 || {};

            var reSkip = /^<|^(?:button|map|select|textarea|object|iframe|option|optgroup)$/i;

            var saveClones = /^(?:a|b|code|div|fieldset|h1|h2|h3|h4|h5|h6|i|label|li|ol|p|q|span|strong|style|table|tbody|td|th|tr|ul)$/i;

            var supportsHtml5Styles;

            var expando = '_html5shiv';

            var expanID = 0;

            var expandoData = {};

            var supportsUnknownElements;

        (function() {
          try {
            var a = document.createElement('a');
            a.innerHTML = '<xyz></xyz>';
                    supportsHtml5Styles = ('hidden' in a);

            supportsUnknownElements = a.childNodes.length == 1 || (function() {
                        (document.createElement)('a');
              var frag = document.createDocumentFragment();
              return (
                typeof frag.cloneNode == 'undefined' ||
                typeof frag.createDocumentFragment == 'undefined' ||
                typeof frag.createElement == 'undefined'
              );
            }());
          } catch(e) {
                    supportsHtml5Styles = true;
            supportsUnknownElements = true;
          }

        }());

            function addStyleSheet(ownerDocument, cssText) {
          var p = ownerDocument.createElement('p'),
          parent = ownerDocument.getElementsByTagName('head')[0] || ownerDocument.documentElement;

          p.innerHTML = 'x<style>' + cssText + '</style>';
          return parent.insertBefore(p.lastChild, parent.firstChild);
        }

            function getElements() {
          var elements = html5.elements;
          return typeof elements == 'string' ? elements.split(' ') : elements;
        }

            function getExpandoData(ownerDocument) {
          var data = expandoData[ownerDocument[expando]];
          if (!data) {
            data = {};
            expanID++;
            ownerDocument[expando] = expanID;
            expandoData[expanID] = data;
          }
          return data;
        }

            function createElement(nodeName, ownerDocument, data){
          if (!ownerDocument) {
            ownerDocument = document;
          }
          if(supportsUnknownElements){
            return ownerDocument.createElement(nodeName);
          }
          if (!data) {
            data = getExpandoData(ownerDocument);
          }
          var node;

          if (data.cache[nodeName]) {
            node = data.cache[nodeName].cloneNode();
          } else if (saveClones.test(nodeName)) {
            node = (data.cache[nodeName] = data.createElem(nodeName)).cloneNode();
          } else {
            node = data.createElem(nodeName);
          }

                                                    return node.canHaveChildren && !reSkip.test(nodeName) && !node.tagUrn ? data.frag.appendChild(node) : node;
        }

            function createDocumentFragment(ownerDocument, data){
          if (!ownerDocument) {
            ownerDocument = document;
          }
          if(supportsUnknownElements){
            return ownerDocument.createDocumentFragment();
          }
          data = data || getExpandoData(ownerDocument);
          var clone = data.frag.cloneNode(),
          i = 0,
          elems = getElements(),
          l = elems.length;
          for(;i<l;i++){
            clone.createElement(elems[i]);
          }
          return clone;
        }

            function shivMethods(ownerDocument, data) {
          if (!data.cache) {
            data.cache = {};
            data.createElem = ownerDocument.createElement;
            data.createFrag = ownerDocument.createDocumentFragment;
            data.frag = data.createFrag();
          }


          ownerDocument.createElement = function(nodeName) {
                    if (!html5.shivMethods) {
              return data.createElem(nodeName);
            }
            return createElement(nodeName, ownerDocument, data);
          };

          ownerDocument.createDocumentFragment = Function('h,f', 'return function(){' +
                                                          'var n=f.cloneNode(),c=n.createElement;' +
                                                          'h.shivMethods&&(' +
                                                                                                                getElements().join().replace(/[\w\-]+/g, function(nodeName) {
            data.createElem(nodeName);
            data.frag.createElement(nodeName);
            return 'c("' + nodeName + '")';
          }) +
            ');return n}'
                                                         )(html5, data.frag);
        }

            function shivDocument(ownerDocument) {
          if (!ownerDocument) {
            ownerDocument = document;
          }
          var data = getExpandoData(ownerDocument);

          if (html5.shivCSS && !supportsHtml5Styles && !data.hasCSS) {
            data.hasCSS = !!addStyleSheet(ownerDocument,
                                                                                'article,aside,dialog,figcaption,figure,footer,header,hgroup,main,nav,section{display:block}' +
                                                                                    'mark{background:#FF0;color:#000}' +
                                                                                    'template{display:none}'
                                         );
          }
          if (!supportsUnknownElements) {
            shivMethods(ownerDocument, data);
          }
          return ownerDocument;
        }

            var html5 = {

                'elements': options.elements || 'abbr article aside audio bdi canvas data datalist details dialog figcaption figure footer header hgroup main mark meter nav output progress section summary template time video',

                'version': version,

                'shivCSS': (options.shivCSS !== false),

                'supportsUnknownElements': supportsUnknownElements,

                'shivMethods': (options.shivMethods !== false),

                'type': 'default',

                'shivDocument': shivDocument,

                createElement: createElement,

                createDocumentFragment: createDocumentFragment
        };

            window.html5 = html5;

            shivDocument(document);

    }(this, document));

    Modernizr._version      = version;

    Modernizr._prefixes     = prefixes;
    Modernizr._domPrefixes  = domPrefixes;
    Modernizr._cssomPrefixes  = cssomPrefixes;

    Modernizr.mq            = testMediaQuery;

    Modernizr.hasEvent      = isEventSupported;

    Modernizr.testProp      = function(prop){
        return testProps([prop]);
    };

    Modernizr.testAllProps  = testPropsAll;


    Modernizr.testStyles    = injectElementWithStyles;
    Modernizr.prefixed      = function(prop, obj, elem){
      if(!obj) {
        return testPropsAll(prop, 'pfx');
      } else {
            return testPropsAll(prop, obj, elem);
      }
    };


    docElement.className = docElement.className.replace(/(^|\s)no-js(\s|$)/, '$1$2') +

                                                    (enableClasses ? ' js ' + classes.join(' ') : '');

    return Modernizr;

})(this, this.document);
/*yepnope1.5.4|WTFPL*/
(function(a,b,c){function d(a){return"[object Function]"==o.call(a)}function e(a){return"string"==typeof a}function f(){}function g(a){return!a||"loaded"==a||"complete"==a||"uninitialized"==a}function h(){var a=p.shift();q=1,a?a.t?m(function(){("c"==a.t?B.injectCss:B.injectJs)(a.s,0,a.a,a.x,a.e,1)},0):(a(),h()):q=0}function i(a,c,d,e,f,i,j){function k(b){if(!o&&g(l.readyState)&&(u.r=o=1,!q&&h(),l.onload=l.onreadystatechange=null,b)){"img"!=a&&m(function(){t.removeChild(l)},50);for(var d in y[c])y[c].hasOwnProperty(d)&&y[c][d].onload()}}var j=j||B.errorTimeout,l=b.createElement(a),o=0,r=0,u={t:d,s:c,e:f,a:i,x:j};1===y[c]&&(r=1,y[c]=[]),"object"==a?l.data=c:(l.src=c,l.type=a),l.width=l.height="0",l.onerror=l.onload=l.onreadystatechange=function(){k.call(this,r)},p.splice(e,0,u),"img"!=a&&(r||2===y[c]?(t.insertBefore(l,s?null:n),m(k,j)):y[c].push(l))}function j(a,b,c,d,f){return q=0,b=b||"j",e(a)?i("c"==b?v:u,a,b,this.i++,c,d,f):(p.splice(this.i++,0,a),1==p.length&&h()),this}function k(){var a=B;return a.loader={load:j,i:0},a}var l=b.documentElement,m=a.setTimeout,n=b.getElementsByTagName("script")[0],o={}.toString,p=[],q=0,r="MozAppearance"in l.style,s=r&&!!b.createRange().compareNode,t=s?l:n.parentNode,l=a.opera&&"[object Opera]"==o.call(a.opera),l=!!b.attachEvent&&!l,u=r?"object":l?"script":"img",v=l?"script":u,w=Array.isArray||function(a){return"[object Array]"==o.call(a)},x=[],y={},z={timeout:function(a,b){return b.length&&(a.timeout=b[0]),a}},A,B;B=function(a){function b(a){var a=a.split("!"),b=x.length,c=a.pop(),d=a.length,c={url:c,origUrl:c,prefixes:a},e,f,g;for(f=0;f<d;f++)g=a[f].split("="),(e=z[g.shift()])&&(c=e(c,g));for(f=0;f<b;f++)c=x[f](c);return c}function g(a,e,f,g,h){var i=b(a),j=i.autoCallback;i.url.split(".").pop().split("?").shift(),i.bypass||(e&&(e=d(e)?e:e[a]||e[g]||e[a.split("/").pop().split("?")[0]]),i.instead?i.instead(a,e,f,g,h):(y[i.url]?i.noexec=!0:y[i.url]=1,f.load(i.url,i.forceCSS||!i.forceJS&&"css"==i.url.split(".").pop().split("?").shift()?"c":c,i.noexec,i.attrs,i.timeout),(d(e)||d(j))&&f.load(function(){k(),e&&e(i.origUrl,h,g),j&&j(i.origUrl,h,g),y[i.url]=2})))}function h(a,b){function c(a,c){if(a){if(e(a))c||(j=function(){var a=[].slice.call(arguments);k.apply(this,a),l()}),g(a,j,b,0,h);else if(Object(a)===a)for(n in m=function(){var b=0,c;for(c in a)a.hasOwnProperty(c)&&b++;return b}(),a)a.hasOwnProperty(n)&&(!c&&!--m&&(d(j)?j=function(){var a=[].slice.call(arguments);k.apply(this,a),l()}:j[n]=function(a){return function(){var b=[].slice.call(arguments);a&&a.apply(this,b),l()}}(k[n])),g(a[n],j,b,n,h))}else!c&&l()}var h=!!a.test,i=a.load||a.both,j=a.callback||f,k=j,l=a.complete||f,m,n;c(h?a.yep:a.nope,!!i),i&&c(i)}var i,j,l=this.yepnope.loader;if(e(a))g(a,0,l,0);else if(w(a))for(i=0;i<a.length;i++)j=a[i],e(j)?g(j,0,l,0):w(j)?B(j):Object(j)===j&&h(j,l);else Object(a)===a&&h(a,l)},B.addPrefix=function(a,b){z[a]=b},B.addFilter=function(a){x.push(a)},B.errorTimeout=1e4,null==b.readyState&&b.addEventListener&&(b.readyState="loading",b.addEventListener("DOMContentLoaded",A=function(){b.removeEventListener("DOMContentLoaded",A,0),b.readyState="complete"},0)),a.yepnope=k(),a.yepnope.executeStack=h,a.yepnope.injectJs=function(a,c,d,e,i,j){var k=b.createElement("script"),l,o,e=e||B.errorTimeout;k.src=a;for(o in d)k.setAttribute(o,d[o]);c=j?h:c||f,k.onreadystatechange=k.onload=function(){!l&&g(k.readyState)&&(l=1,c(),k.onload=k.onreadystatechange=null)},m(function(){l||(l=1,c(1))},e),i?k.onload():n.parentNode.insertBefore(k,n)},a.yepnope.injectCss=function(a,c,d,e,g,i){var e=b.createElement("link"),j,c=i?h:c||f;e.href=a,e.rel="stylesheet",e.type="text/css";for(j in d)e.setAttribute(j,d[j]);g||(n.parentNode.insertBefore(e,n),m(c,0))}})(this,document);
Modernizr.load=function(){yepnope.apply(window,[].slice.call(arguments,0));};
// last-child pseudo selector
// https://github.com/Modernizr/Modernizr/pull/304


Modernizr.addTest('lastchild', function(){

  return Modernizr.testStyles("#modernizr div {width:100px} #modernizr :last-child{width:200px;display:block}", function (elem) {
    return elem.lastChild.offsetWidth > elem.firstChild.offsetWidth;
  }, 2);

});
// Method of allowing calculated values for length units, i.e. width: calc(100%-3em) http://caniuse.com/#search=calc
// By @calvein

Modernizr.addTest('csscalc', function() {
    var prop = 'width:';
    var value = 'calc(10px);';
    var el = document.createElement('div');

    el.style.cssText = prop + Modernizr._prefixes.join(value + prop);

    return !!el.style.length;
});
// Sticky positioning - constrains an element to be positioned inside the
// intersection of its container box, and the viewport.
Modernizr.addTest('csspositionsticky', function () {

    var prop = 'position:';
    var value = 'sticky';
    var el = document.createElement('modernizr');
    var mStyle = el.style;

    mStyle.cssText = prop + Modernizr._prefixes.join(value + ';' + prop).slice(0, -prop.length);

    return mStyle.position.indexOf(value) !== -1;
});


Modernizr.addTest('mediaqueries', Modernizr.mq('only all'));// code.google.com/speed/webp/
// by rich bradshaw, ryan seddon, and paul irish


// This test is asynchronous. Watch out.

(function(){

  var image = new Image();

  image.onerror = function() {
      Modernizr.addTest('webp', false);
  };  
  image.onload = function() {
      Modernizr.addTest('webp', function() { return image.width == 1; });
  };

  image.src = 'data:image/webp;base64,UklGRiwAAABXRUJQVlA4ICAAAAAUAgCdASoBAAEAL/3+/3+CAB/AAAFzrNsAAP5QAAAAAA==';

}());;
// NumFuzz.js
//
// Copyright (C) 2013 Ramon Torres <http://github.com/raymondjavaxx>
// Licenced under the MIT License <http://opensource.org/licenses/MIT>
var jquery_assets = {
  _jquery_local       : { js : myPrefix + 'vendor/' + 'jquery/jquery.min.js' },
}

Modernizr.load({
  load    : [
    jquery_assets._jquery_local.js,
  ],
  complete: function() {
    (function () {
      "use strict";

      var NumFuzz = {};

      NumFuzz.fuzzy = function (number) {
        if (typeof number !== 'number') {
          number = parseInt(number, 10);
        }

        if (Math.abs(number) >= 1000000) {
          return this.round(number / 1000000.0, 1) + "M";
        }

        if (Math.abs(number) >= 1000) {
          return this.round(number / 1000.0, 1) + "k";
        }

        return number.toString();
      };

      NumFuzz.round = function (number, dec) {
        var truncated = Number((Math.floor(number * 10) / 10).toFixed(dec));
        if (truncated % 1 === 0) {
          return truncated.toFixed(0);
        }

        return truncated.toFixed(1);
      };

      window['NumFuzz'] = NumFuzz;
    })();

    // jQuery micro-pluggin
    (function ($) {
      $.fn.numFuzz = function (method) {
        this.each(function (i, elem) {
          var num = parseInt($(elem).text(), 10);
          var fuzzy = NumFuzz.fuzzy(num);
          $(elem).attr('title', num.toLocaleString()).text(fuzzy).data('numfuzz-val', num);
        });
      };
    })(jQuery);
  }
});


var path = {
    plugins : myPrefix + 'vendor/'
  };
var assets = {
  _jquery_local       : { js : path.plugins + 'jquery/jquery.min.js' },
  _materialize_local  : { js : path.plugins + 'materialize/js/materialize.min.js' },
  _bootstrap_local    : { js : path.plugins + 'bootstrap/js/bootstrap.min.js' },
  _abbr_number        : { js : path.plugins + 'numfuzz/numfuzz.js' },
  _popover            : { js : path.plugins + 'webui-popover/jquery.webui-popover.min.js' },
  _masonry            : { js : path.plugins + 'masonry/masonry.pkgd.min.js' },
  _infiniteScroll     : { js : path.plugins + 'infinite-scroll/jquery.infinitescroll.min.js' },
  _summernote         : {
                          css : path.plugins + 'summernote/summernote.min.css',
                          js : path.plugins + 'summernote/summernote.min.js',
                          lang : path.plugins + 'summernote/lang/summernote-id-ID.js'
                        },
  _tooltip            : { js : path.plugins + 'tooltipster/js/tooltipster.bundle.min.js' },
  _slick              : { js : path.plugins + 'slick/slick.min.js' },
  _colorbox           : { js : path.plugins + 'colorbox/jquery.colorbox-min.js' },
  _slimscroll         : { js : path.plugins + 'slimscroll/jquery.slimscroll.min.js' },
  _notify             : { js : path.plugins + 'notify/bootstrap-notify.min.js' },
  _select2            : { js : path.plugins + 'select2/js/select2.full.min.js' },
  _masonry            : { js : path.plugins + 'masonry/masonry.pkgd.min.js' },
  _infiniteScroll     : { js : path.plugins + 'infinite-scroll/jquery.infinitescroll.min.js' },
};

var Site = {
  init : function() {
    Site.formMaterialize();
    Site.numfuzz();
    Site.bannerInit();
    Site.navbarInit();
    Site.popoverInit();
    Site.popularIdeaInit();
    Site.quickLookInit();
    Site.searchMenuBarInit();
    Site.tooltipInit();
    Site.alertNotificationInit();
    Site.selectInit();
    Site.masonryInit();
  },
  slickLoad : function($callback, $args = []) {
    Modernizr.load({
      load    : [
        assets._slick.js,
      ],
      complete: function(){
        $callback(...$args);
      }
    });
  },
  colorboxLoad : function($callback, $args = []) {
    Modernizr.load({
      load    : [
        assets._colorbox.js,
      ],
      complete: function(){
        $callback(...$args);
      }
    });
  },
  slimscrollLoad : function($callback, $args = []) {
    Modernizr.load({
      load    : [
        assets._slimscroll.js,
      ],
      complete: function(){
        $callback(...$args);
      }
    });
  },
  popoverLoad : function($callback, $args = []) {
    Modernizr.load({
      load    : [
        assets._popover.js,
      ],
      complete: function(){
        $callback(...$args);
      }
    });
  },
  tooltipLoad : function($callback, $args = []) {
    Modernizr.load({
      load    : [
        assets._tooltip.js,
      ],
      complete: function(){
        $callback(...$args);
      }
    });
  },
  notifyLoad : function($callback, $args = []) {
    Modernizr.load({
      load  : [
              assets._notify.js,
      ],
      complete : function(){
        $callback(...$args);
      }
    });
  },
  select2Load : function($callback, $args = []) {
    Modernizr.load({
      load  : [
              assets._select2.js,
      ],
      complete : function(){
        $callback(...$args);
      }
    });
  },
  masonryLoad : function($callback, $args = []){
    Modernizr.load({
      load  : [
              assets._masonry.js,
      ],
      complete : function(){
        $callback(...$args);
      }
    });
  },
  infiniteScrollLoad : function($callback, $args = []) {
    Modernizr.load({
      load  : [
              assets._infiniteScroll.js
      ],
      complete : function(){
        $callback(...$args);
      }
    });
  },
  navbarInit : function() {
    $(".button-collapse").sideNav();
  },
  searchMenuBarInit : function(){
    $('.searchbox-icon').click(function(){
      if($('.searchbox.searchbox-open').length == 0){
        $('.searchbox').addClass('searchbox-open');
        $('.searchbox-input').focus();
      } else {
        $('.searchbox').removeClass('searchbox-open');
        $('.searchbox-input').focusout();
      }
    });
    $('.searchbox-mobile-icon').click(function(){
      if($('.searchbox-mobile.open').length == 0){
        $('.searchbox-mobile').addClass('open');
        $('.searchbox-input').focus();
      } else {
        $('.searchbox-mobile').removeClass('open');
        $('.searchbox-input').focusout();
      }
    });
  },
  popoverInit : function() {
    if ($('.popover').length > 0) {
      Site.popoverLoad(Site.popover);
    }
  },
  popover : function() {
    $('.popover').each(function(){
      $popupTrigger = $(this).data('trigger') ? $(this).data('trigger') : 'click';
      $(this).webuiPopover({
        trigger: $popupTrigger,
      });
    });
  },
  textEditorInit : function() {
    $('[summernote]').each(function(){
      $(this).materialnote({
        lang : 'id-ID',
        height: $(this).height(),
        toolbar: [
          ['style', ['bold', 'italic', 'underline', 'clear']],
          ['fontsize', ['fontsize']],
          ['color', ['color']],
          ['para', ['ul', 'ol', 'paragraph']],
          ['height', ['height']]
        ]
      });
    });
  },
  formMaterialize : function() {
    $('.input-field label').each(function(){
      $(this).click(function() {
        $(this).prev().focus();
      });
    });
  },
  tooltipInit : function() {
    if ($('.tooltipster').length > 0) {
      Site.tooltipLoad(Site.tooltip);
    }
  },
  tooltip : function(){
    $('.tooltipster').each(function(e){
      $(this).tooltipster({
        theme: ['tooltipster-noir', 'tooltipster-noir-customized'],
        side: $(this).data('placement')
      });
    });
  },
  bannerInit : function() {
    Site.slickLoad(Site.banner);
  },
  banner : function() {
    $('.banners').each(function(i){
      $(this).slick({
        dots: true,
        infinite: true,
        autoplay: true,
        speed: 300,
        prevArrow: "<a class='left slider-control slick-prev'><i class='fa fa-chevron-left fa-lg'></i></a>",
        nextArrow: "<a class='right slider-control slick-next'><i class='fa fa-chevron-right fa-lg'></i></a>",
        fade: true,
        cssEase: 'linear',
      });
    })
  },
  popularIdeaInit : function() {
    Site.slickLoad(Site.popularIdea);
  },
  popularIdea : function() {
    $('section.popular-idea .idea-list').each(function(i){
      $(this).on('init', function(){
        Site.popularIdeaPushPinInit()
      });
      $(this).slick({
        infinite: false,
        speed: 300,
        slidesToShow: 3,
        prevArrow: "",
        nextArrow: "",
        responsive: [
          {
            breakpoint: 1024,
            settings: {
              slidesToShow: 3,
              slidesToScroll: 3,
            }
          },
          {
            breakpoint: 600,
            settings: {
              slidesToShow: 1,
              slidesToScroll: 1
            }
          },
          {
            breakpoint: 480,
            settings: {
              slidesToShow: 1,
              slidesToScroll: 1
            }
          }
        ]
      });
    });
  },
  popularIdeaPushPinInit : function() {
    $('.pushpin').each(function(i){
      $target = $('#' + $(this).attr('data-target'));
      $top = $target.offset().top;
      $bottom = $target.offset().top + $target.outerHeight();
      $(this).pushpin({
        top: $top,
        bottom: $bottom,
      });
    });
  },
  numfuzz : function($selector = null) {
    if ($selector) {
      $selector.numFuzz();
    } else {
      $('.abbr-number').numFuzz();
    }
  },
  quickLookInit : function() {
    if ($('.quick-look').length > 0) {
      Site.colorboxLoad(Site.quickLook);
    }
  },
  quickLook : function() {
    $('.quick-look').each(function(i){
      $maxWidth = '75%';
      if ($(window).width() < 992) {
        $maxWidth = '95%';
      }
      $(this).colorbox({
        transition: 'fade',
        maxWidth: $maxWidth,
        height: '500px',
        title: false,
        close: '<i class="fa fa-close"></i>',
        className: 'quick-look--modal'
      });
    });
    $(document).bind('cbox_complete', function(){
      Site.galleryQuickLookInit();
      Site.slimscrollLoad(Site.colorboxScroll, ['500px']);
      Site.numfuzz($('.quick-look--meta-number'));
    });
  },
  colorboxScroll : function($height) {
    $('#cboxLoadedContent').slimScroll({
      height: $height
    });
  },
  galleryQuickLookInit : function() {
    Site.slickLoad(Site.galleryQuickLook);
  },
  galleryQuickLook : function() {
    $('.quick-look--modal .gallery').slick({
      dots: true,
      infinite: true,
      autoplay: true,
      speed: 300,
      prevArrow: "<a class='left slider-control slick-prev'><i class='fa fa-chevron-left fa-lg'></i></a>",
      nextArrow: "<a class='right slider-control slick-next'><i class='fa fa-chevron-right fa-lg'></i></a>",
      fade: true,
      cssEase: 'linear',
    });
  },
  alertNotificationInit : function() {
    Site.notifyLoad(Site.alertNotification);
  },
  alertNotification : function() {
    if ($('#notification-success').length > 0) {
      Site.showAlertNotification('success', $('#notification-success'));
    }
    if ($('#notification-alert').length > 0) {
      Site.showAlertNotification('warning', $('#notification-alert'));
    }
    if ($('#notification-info').length > 0) {
      Site.showAlertNotification('info', $('#notification-info'));
    }
    if ($('#notification-error').length > 0) {
      Site.showAlertNotification('danger', $('#notification-error'));
    }
  },
  showAlertNotification : function($type, $selector) {
    $.notify({
      message: $selector.data('text'),
    },{
      // settings
      element: 'body',
      position: null,
      type: $type,
      allow_dismiss: true,
      placement: {
        from: "top",
        align: "center"
      },
      offset: 200,
      spacing: 10,
      z_index: 1031,
      delay: 2500,
      animate: {
        enter: 'animated fadeInDown',
        exit: 'animated fadeOutUp'
      },
      template: '<div data-notify="container" class="col-xs-11 col-sm-3 alert alert-{0} text-center" role="alert">' +
        '<button type="button" aria-hidden="true" class="close" data-notify="dismiss">×</button>' +
        '<span data-notify="icon"></span> ' +
        '<span data-notify="title">{1}</span> ' +
        '<span data-notify="message">{2}</span>' +
        '<div class="progress" data-notify="progressbar">' +
          '<div class="progress-bar progress-bar-{0}" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>' +
        '</div>' +
        '<a href="{3}" target="{4}" data-notify="url"></a>' +
      '</div>'
    });
  },
  selectInit : function () {
    if ($('select').length > 0) {
      Site.select2Load(Site.select);
    }
  },
  select : function() {
    $('select').each(function(e){
      if ($(this).data('tag')) {
        $(this).select2({
          language: "id",
          tags: true,
          theme: "bootstrap",
          tokenSeparators: [',']
        })
      }else {
        $(this).select2({
          language: "id",
          theme: "bootstrap",
          placeholder: $(this).attr('placeholder')
        });
        $(this).on('change', function(evt){
          if ($(this).val() == 'event') {
            $('.show-cat-event').removeClass('hidden');
          } else {
            $('.show-cat-event').addClass('hidden');
          }
        });
      }
    });
  },
  masonryInit : function(){
    if ($('.grid').length > 0) {
      Site.masonryLoad(Site.masonry);
    }
  },
  masonry : function(){
    $('.grid').masonry({
      itemSelector: '.grid-item',
    });
    Site.infiniteScrollLoad(Site.masonryItemMore);
  },
  masonryItemMore : function() {
    $('.grid').infinitescroll({
      navSelector  : ".read-more",
      nextSelector : ".read-more a",
      itemSelector : ".grid-item",
      loading: {
        finishedMsg: 'No more pages to load.'
        }
      },
      function( $newElements ) {
        $('.grid').masonry( 'appended', $newElements, true );
    });
  },
};

var checkJquery = function () {
  Modernizr.load([
    {
      test    : window.jQuery,
      nope    : assets._jquery_local.js,
      complete: Site.init
    }
  ]);
};

Modernizr.load({
  load    : [
    assets._jquery_local.js,
    assets._bootstrap_local.js,
    assets._materialize_local.js,
  ],
  complete: checkJquery
});
//# sourceMappingURL=application.js.map
