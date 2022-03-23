!function(){var e,t={155:function(e,t,n){"use strict";function o(){return(o=Object.assign||function(e){for(var t=1;t<arguments.length;t++){var n=arguments[t];for(var o in n)Object.prototype.hasOwnProperty.call(n,o)&&(e[o]=n[o])}return e}).apply(this,arguments)}var a=window.wp.element,i=window.wp.hooks,l=window.wp.blocks,s=window.wp.compose,r=window.wp.domReady,c=n.n(r),m=n(711),u=n.n(m);function b(e,t,n){return t in e?Object.defineProperty(e,t,{value:n,enumerable:!0,configurable:!0,writable:!0}):e[t]=n,e}var d=window.wp.i18n,f=window.wp.blockEditor,p=window.wp.components,h=n(184),_=n.n(h);let k;var v=k=()=>{const[e,t]=(0,a.useState)(!1);return(0,a.createElement)(a.Fragment,null,(0,a.createElement)(p.Button,{isSecondary:!0,className:"anfb-help-button","aria-label":(0,d.__)("Show Animations for Blocks help","animations-for-blocks"),onClick:()=>t(!0),text:(0,d.__)("Show help")}),e&&(0,a.createElement)(p.Modal,{className:"wsd-anfb-help",title:(0,d.__)("Animations for Blocks help","animations-for-blocks"),onRequestClose:()=>t(!1)},(0,a.createElement)("div",{className:"anfb-help"},(0,a.createElement)("h3",null,(0,d.__)("Options","animations-for-blocks")),(0,a.createElement)("h4",null,(0,d.__)("Animation","animations-for-blocks")),(0,a.createElement)("p",null,(0,d.__)("Allows to select the type of animation you wish to use: Fade, Flip, Slide or Zoom. Set to None if you no longer wish to animate that block.","animations-for-blocks")),(0,a.createElement)("h4",null,(0,d.__)("Animation variation","animations-for-blocks")),(0,a.createElement)("p",null,(0,d.__)("Allows to switch between the different variations of the selected animation, such as Fade in, Fade down, Slide left, Slide right, Zoom in, Zoom out, Zoom out left, etc.","animations-for-blocks")),(0,a.createElement)("h4",null,(0,d.__)("Animation delay","animations-for-blocks")),(0,a.createElement)("p",null,(0,d.__)("Time in milliseconds to delay the animation (0 - 3000ms). Increasing this value will delay the appearance of the animated element.","animations-for-blocks")),(0,a.createElement)("h4",null,(0,d.__)("Animation duration","animations-for-blocks")),(0,a.createElement)("p",null,(0,d.__)("Time in milliseconds that the animation takes to complete (0 - 3000ms). Increasing this value will make the animation play longer.","animations-for-blocks")),(0,a.createElement)("h4",null,(0,d.__)("Once","animations-for-blocks")),(0,a.createElement)("p",null,(0,d.__)("When enabled, animation will only happen once, when scrolling down the page for the first time. When user scrolls up again and then down, then the block will no longer animate.","animations-for-blocks")),(0,a.createElement)("h4",null,(0,d.__)("Mirror","animations-for-blocks")),(0,a.createElement)("p",null,(0,d.__)("When enabled, elements will animate out once the user has scrolled past them and will animate in when the user scrolls up again.","animations-for-blocks")),(0,a.createElement)("h4",null,(0,d.__)("Easing","animations-for-blocks")),(0,a.createElement)("p",null,(0,d.__)("Allows to change between various CSS transition timing functions for the animation making it unfold differently.","animations-for-blocks")),(0,a.createElement)("h4",null,(0,d.__)("Anchor placement","animations-for-blocks")),(0,a.createElement)("p",null,(0,d.__)("Allows to control what part of the animated element should trigger the animation when it becomes visible in the viewport.","animations-for-blocks")),(0,a.createElement)("h4",null,(0,d.__)("Offset","animations-for-blocks")),(0,a.createElement)("p",null,(0,d.__)("Controls the offset (in pixels) from the original trigger point at which the animation should trigger in the viewport.","animations-for-blocks")),(0,a.createElement)("h3",null,(0,d.__)("Broken block","animations-for-blocks")),(0,a.createElement)("p",null,(0,d.__)('If you enabled animation and the block broke it means it is not supported. Feel free to report it. To restore the block in working condition try "Undo", if possible "Attempt Block Recovery", or change to "Code editor" (Ctrl + Shift + Alt + M) and remove the animation attributes (eg: \'"animationsForBlocks":{"animation":"fade"}\') from the broken block.',"animations-for-blocks")))))};const g=[{label:(0,d.__)("None","animations-for-blocks"),value:"none"},{label:(0,d.__)("Fade","animations-for-blocks"),value:"fade"},{label:(0,d.__)("Flip","animations-for-blocks"),value:"flip"},{label:(0,d.__)("Slide","animations-for-blocks"),value:"slide"},{label:(0,d.__)("Zoom","animations-for-blocks"),value:"zoom"}],w={fade:[{label:(0,d.__)("Fade in","animations-for-blocks"),value:"fade"},{label:(0,d.__)("Fade up","animations-for-blocks"),value:"up"},{label:(0,d.__)("Fade down","animations-for-blocks"),value:"down"},{label:(0,d.__)("Fade left","animations-for-blocks"),value:"left"},{label:(0,d.__)("Fade right","animations-for-blocks"),value:"right"},{label:(0,d.__)("Fade up left","animations-for-blocks"),value:"up-left"},{label:(0,d.__)("Fade up right","animations-for-blocks"),value:"up-right"},{label:(0,d.__)("Fade down left","animations-for-blocks"),value:"down-left"},{label:(0,d.__)("Fade down right","animations-for-blocks"),value:"down-right"}],flip:[{label:(0,d.__)("Flip up","animations-for-blocks"),value:"up"},{label:(0,d.__)("Flip down","animations-for-blocks"),value:"down"},{label:(0,d.__)("Flip left","animations-for-blocks"),value:"left"},{label:(0,d.__)("Flip right","animations-for-blocks"),value:"right"}],slide:[{label:(0,d.__)("Slide up","animations-for-blocks"),value:"up"},{label:(0,d.__)("Slide down","animations-for-blocks"),value:"down"},{label:(0,d.__)("Slide left","animations-for-blocks"),value:"left"},{label:(0,d.__)("Slide right","animations-for-blocks"),value:"right"}],zoom:[{label:(0,d.__)("Zoom in","animations-for-blocks"),value:"in"},{label:(0,d.__)("Zoom in up","animations-for-blocks"),value:"in-up"},{label:(0,d.__)("Zoom in down","animations-for-blocks"),value:"in-down"},{label:(0,d.__)("Zoom in left","animations-for-blocks"),value:"in-left"},{label:(0,d.__)("Zoom in right","animations-for-blocks"),value:"in-right"},{label:(0,d.__)("Zoom out","animations-for-blocks"),value:"out"},{label:(0,d.__)("Zoom out up","animations-for-blocks"),value:"out-up"},{label:(0,d.__)("Zoom out down","animations-for-blocks"),value:"out-down"},{label:(0,d.__)("Zoom out left","animations-for-blocks"),value:"out-left"},{label:(0,d.__)("Zoom out right","animations-for-blocks"),value:"out-right"}]},E=[{label:(0,d.__)("ease","animations-for-blocks"),value:"ease"},{label:(0,d.__)("ease-in","animations-for-blocks"),value:"ease-in"},{label:(0,d.__)("ease-out","animations-for-blocks"),value:"ease-out"},{label:(0,d.__)("ease-in-out","animations-for-blocks"),value:"ease-in-out"},{label:(0,d.__)("ease-in-back","animations-for-blocks"),value:"ease-in-back"},{label:(0,d.__)("ease-out-back","animations-for-blocks"),value:"ease-out-back"},{label:(0,d.__)("ease-in-out-back","animations-for-blocks"),value:"ease-in-out-back"},{label:(0,d.__)("ease-in-sine","animations-for-blocks"),value:"ease-in-sine"},{label:(0,d.__)("ease-out-sine","animations-for-blocks"),value:"ease-out-sine"},{label:(0,d.__)("ease-in-out-sine","animations-for-blocks"),value:"ease-in-out-sine"},{label:(0,d.__)("ease-in-quad","animations-for-blocks"),value:"ease-in-quad"},{label:(0,d.__)("ease-out-quad","animations-for-blocks"),value:"ease-out-quad"},{label:(0,d.__)("ease-in-out-quad","animations-for-blocks"),value:"ease-in-out-quad"},{label:(0,d.__)("ease-in-cubic","animations-for-blocks"),value:"ease-in-cubic"},{label:(0,d.__)("ease-out-cubic","animations-for-blocks"),value:"ease-out-cubic"},{label:(0,d.__)("ease-in-out-cubic","animations-for-blocks"),value:"ease-in-out-cubic"},{label:(0,d.__)("ease-in-quart","animations-for-blocks"),value:"ease-in-quart"},{label:(0,d.__)("ease-out-quart","animations-for-blocks"),value:"ease-out-quart"},{label:(0,d.__)("ease-in-out-quart","animations-for-blocks"),value:"ease-in-out-quart"},{label:(0,d.__)("linear","animations-for-blocks"),value:"linear"}],A=[{label:(0,d.__)("top-bottom","animations-for-blocks"),value:"top-bottom"},{label:(0,d.__)("center-bottom","animations-for-blocks"),value:"center-bottom"},{label:(0,d.__)("bottom-bottom","animations-for-blocks"),value:"bottom-bottom"},{label:(0,d.__)("top-center","animations-for-blocks"),value:"top-center"},{label:(0,d.__)("center-center","animations-for-blocks"),value:"center-center"},{label:(0,d.__)("bottom-center","animations-for-blocks"),value:"bottom-center"},{label:(0,d.__)("top-top","animations-for-blocks"),value:"top-top"},{label:(0,d.__)("bottom-top","animations-for-blocks"),value:"bottom-top"},{label:(0,d.__)("center-top","animations-for-blocks"),value:"center-top"}],y=new CustomEvent("anfb:update");class C extends a.Component{constructor(){super(...arguments),this.state={showAdvancedSettings:!1},this.updateAttributes=this.updateAttributes.bind(this)}componentDidMount(){this.anfbUpdateEvent=new CustomEvent("anfb:update:"+this.props.clientId)}updateAttributes(e){let{animationsForBlocks:t}=this.props.attributes,n=Object.assign({},t,e);this.props.setAttributes({animationsForBlocks:n}),n.animation&&"none"!==n.animation&&document.dispatchEvent(this.anfbUpdateEvent)}render(){let{animationsForBlocks:e}=this.props.attributes;if(!e)return null;let{showAdvancedSettings:t}=this.state,{animation:n,variation:o,delay:i,duration:l,once:s,mirror:r,easing:c,offset:m,anchorPlacement:u}=e;return(0,a.createElement)(f.InspectorControls,null,(0,a.createElement)(p.PanelBody,{title:(0,d.__)("Animation","animations-for-blocks"),className:"wsd-anfb",initialOpen:!!n&&"none"!==n},(0,a.createElement)(p.RadioControl,{label:(0,d.__)("Select animation","animations-for-blocks"),options:g,selected:n||"none",onChange:e=>{this.updateAttributes({animation:e,variation:"none"===e||w[e].map((e=>e.value)).includes(o)?o:w[e][0].value})}}),n&&"none"!==n&&(0,a.createElement)(a.Fragment,null,(0,a.createElement)(p.RadioControl,{label:(0,d.__)("Animation variation","animations-for-blocks"),options:w[n],selected:o||w[n][0].value,onChange:e=>this.updateAttributes({variation:e})}),(0,a.createElement)(p.RangeControl,{label:(0,d.__)("Animation delay (ms)","animations-for-blocks"),value:i||0,onChange:e=>this.updateAttributes({delay:e}),min:0,step:50,max:3e3}),(0,a.createElement)(p.RangeControl,{label:(0,d.__)("Animation duration (ms)","animations-for-blocks"),value:l||400,onChange:e=>this.updateAttributes({duration:e}),min:0,step:50,max:3e3}),(0,a.createElement)(p.ButtonGroup,{className:"top attached anfb-button-group"},(0,a.createElement)(p.Button,{className:"anfb-button",isSecondary:!0,onClick:()=>document.dispatchEvent(this.anfbUpdateEvent),text:(0,d.__)("Animate block","animations-for-blocks")}),(0,a.createElement)(p.Button,{className:"anfb-button",isSecondary:!0,onClick:()=>document.dispatchEvent(y),text:(0,d.__)("Animate all blocks","animations-for-blocks")})),(0,a.createElement)(p.ButtonGroup,{className:"bottom attached anfb-button-group"},(0,a.createElement)(p.Button,{className:_()("anfb-button",{"is-toggled":t}),isSecondary:!0,onClick:()=>this.setState({showAdvancedSettings:!t}),text:(0,d.__)("Advanced settings","animations-for-blocks")}),(0,a.createElement)(v,null)),(0,a.createElement)("div",{className:"anfb-advanced-settings",style:{display:t?"block":"none"}},(0,a.createElement)(p.ToggleControl,{label:(0,d.__)("Once","animations-for-blocks"),help:(0,d.__)("Animate only once, when scrolling down for the first time.","animations-for-blocks"),checked:!!s,onChange:()=>this.updateAttributes({once:!s,mirror:!s&&r?!r:r})}),(0,a.createElement)(p.ToggleControl,{label:(0,d.__)("Mirror","animations-for-blocks"),help:(0,d.__)("Animate out after scrolling past the element and in when scrolling up again.","animations-for-blocks"),checked:!!r,onChange:()=>this.updateAttributes({mirror:!r,once:!r&&s?!s:s})}),(0,a.createElement)(p.SelectControl,{label:(0,d.__)("Easing","animations-for-blocks"),help:(0,d.__)("Transition timing function","animations-for-blocks"),options:E,selected:c||E[0].value,onChange:e=>this.updateAttributes({easing:e})}),(0,a.createElement)(p.SelectControl,{label:(0,d.__)("Anchor placement","animations-for-blocks"),help:(0,d.__)("Defines which position of the element regarding to window should trigger the animation.","animations-for-blocks"),options:A,selected:u||A[0].value,onChange:e=>this.updateAttributes({anchorPlacement:e})}),(0,a.createElement)(p.TextControl,{label:(0,d.__)("Offset","animations-for-blocks"),help:(0,d.__)("Offset (px) from the original trigger point.","animations-for-blocks"),type:"number",value:m||120,onChange:e=>this.updateAttributes({offset:parseInt(e)})})))))}}b(C,"anfbUpdateEvent",!1);var S=C;const F=e=>{let t={};if(!e)return t;const{animation:n,variation:o,delay:a,duration:i,once:l,mirror:s,easing:r,offset:c,anchorPlacement:m}=e;return n&&"none"!==n?(t["data-aos"]=n===o?n:n+"-"+o,a&&0!==a&&(t["data-aos-delay"]=parseInt(a)),i&&400!==i&&(t["data-aos-duration"]=parseInt(i)),l&&(t["data-aos-once"]="true"),s&&(t["data-aos-mirror"]="true"),r&&"ease"!==r&&(t["data-aos-easing"]=r),c&&120!==c&&(t["data-aos-offset"]=parseInt(c)),m&&"top-bottom"!==m&&(t["data-aos-anchor-placement"]=m),t):t};class B extends a.Component{constructor(e){super(e),this.state={animated:!1},this.animate=this.animate.bind(this),this.onAnimationStart=this.onAnimationStart.bind(this),this.onAnimationComplete=this.onAnimationComplete.bind(this),this.refreshAOS=this.refreshAOS.bind(this),this.getWrapperProps=this.getWrapperProps.bind(this)}animate(){if(this.state.animated)this.setState({animated:!1});else{const e=document.getElementById("block-"+this.props.clientId);e&&e.setAttribute("data-aos-duration",50),clearTimeout(this.onAnimationCompleteTimeout),this.onAnimationComplete(!0)}}onAnimationStart(){const{animationsForBlocks:e}=this.props.block.attributes,{delay:t,duration:n}=e,o=(t||0)+(n||400);this.onAnimationCompleteTimeout=setTimeout((()=>this.onAnimationComplete()),o)}onAnimationComplete(e=!1){const t=document.getElementById("block-"+this.props.clientId);t&&(t.classList.remove("aos-init"),t.classList.remove("aos-animate")),this.setState({animated:!0},(()=>{e&&this.setState({animated:!1})}))}refreshAOS(){clearTimeout(this.aosRefreshTimeout),this.aosRefreshTimeout=setTimeout((()=>u().refreshHard()),250)}componentDidMount(){document.addEventListener("aos:in:"+this.props.clientId,this.onAnimationStart),document.addEventListener("anfb:update:"+this.props.clientId,this.animate),document.addEventListener("anfb:update",this.animate)}componentWillUnmount(){document.removeEventListener("aos:in:"+this.props.clientId,this.onAnimationStart),document.removeEventListener("anfb:update:"+this.props.clientId,this.animate),document.removeEventListener("anfb:update",this.animate)}componentDidUpdate(e,t){t.animated&&!this.state.animated&&this.refreshAOS()}getWrapperProps(){let{wrapperProps:e}=this.props;if(!this.state.animated){const{animationsForBlocks:t}=this.props.block.attributes,n=F(t);n["data-aos"]&&(delete n["data-aos-once"],delete n["data-aos-mirror"],delete n["data-aos-offset"],delete n["data-aos-anchorPlacement"],e={...e,...n,"data-aos-id":this.props.clientId,"data-aos-anchor":".block-editor-block-list__block"})}return e}render(){const{BlockListBlock:e}=this.props;return(0,a.createElement)(e,o({},this.props,{wrapperProps:this.getWrapperProps()}))}}b(B,"onAnimationCompleteTimeout",!1),b(B,"aosRefreshTimeout",!1);const O={title:(0,d.__)("Animation container","animations-for-blocks"),description:(0,d.__)("A container that can be animated. Can be used to animate dynamic or other unsupported blocks.","animations-for-blocks"),icon:"media-interactive",category:"design",attributes:{},supports:{anchor:!0,animationsForBlocks:!0},edit:()=>(0,a.createElement)("div",{style:{padding:"1px 0"}},(0,a.createElement)(f.InnerBlocks,null)),save:()=>(0,a.createElement)("div",null,(0,a.createElement)(f.InnerBlocks.Content,null))};c()((()=>{(0,l.registerBlockType)("anfb/animation-container",O)}));const T=(0,i.applyFilters)("anfb.defaultEnabled",!0),x=e=>{const t=e.name||e;return!window.anfbData.unsupportedBlocks.includes(t)&&(0,l.hasBlockSupport)(e,"animationsForBlocks",T)},I={animationsForBlocks:{type:"object",default:{}}},P=(0,s.createHigherOrderComponent)((function(e){return function(t){return x(t.name)?(0,a.createElement)(a.Fragment,null,(0,a.createElement)(e,t),(0,a.createElement)(S,t)):(0,a.createElement)(e,t)}}),"withAnimationsForBlocksInspectorControls"),j=(0,s.createHigherOrderComponent)((e=>t=>x(t.name)?(0,a.createElement)(B,o({},t,{BlockListBlock:e})):(0,a.createElement)(e,t)),"withAnimatedBlockListBlock");(0,i.addFilter)("blocks.registerBlockType","wsd-anfb/attributes",(function(e){return x(e)&&(e.attributes=Object.assign(e.attributes||{},I)),e})),(0,i.addFilter)("editor.BlockEdit","wsd-anfb/inspector-controls",P),(0,i.addFilter)("blocks.getSaveContent.extraProps","wsd-anfb/animation-props",((e,t,n)=>{if(x(t)){let{animationsForBlocks:t}=n;const o=F(t);o["data-aos"]&&(e={...e,...o})}return e})),(0,i.addFilter)("editor.BlockListBlock","wsd-anfb/blocklistblock-animation",j),c()((()=>setTimeout((()=>u().init()),250)))},184:function(e,t){var n;!function(){"use strict";var o={}.hasOwnProperty;function a(){for(var e=[],t=0;t<arguments.length;t++){var n=arguments[t];if(n){var i=typeof n;if("string"===i||"number"===i)e.push(n);else if(Array.isArray(n)){if(n.length){var l=a.apply(null,n);l&&e.push(l)}}else if("object"===i)if(n.toString===Object.prototype.toString)for(var s in n)o.call(n,s)&&n[s]&&e.push(s);else e.push(n.toString())}}return e.join(" ")}e.exports?(a.default=a,e.exports=a):void 0===(n=function(){return a}.apply(t,[]))||(e.exports=n)}()}},n={};function o(e){var a=n[e];if(void 0!==a)return a.exports;var i=n[e]={exports:{}};return t[e].call(i.exports,i,i.exports,o),i.exports}o.m=t,e=[],o.O=function(t,n,a,i){if(!n){var l=1/0;for(m=0;m<e.length;m++){n=e[m][0],a=e[m][1],i=e[m][2];for(var s=!0,r=0;r<n.length;r++)(!1&i||l>=i)&&Object.keys(o.O).every((function(e){return o.O[e](n[r])}))?n.splice(r--,1):(s=!1,i<l&&(l=i));if(s){e.splice(m--,1);var c=a();void 0!==c&&(t=c)}}return t}i=i||0;for(var m=e.length;m>0&&e[m-1][2]>i;m--)e[m]=e[m-1];e[m]=[n,a,i]},o.n=function(e){var t=e&&e.__esModule?function(){return e.default}:function(){return e};return o.d(t,{a:t}),t},o.d=function(e,t){for(var n in t)o.o(t,n)&&!o.o(e,n)&&Object.defineProperty(e,n,{enumerable:!0,get:t[n]})},o.g=function(){if("object"==typeof globalThis)return globalThis;try{return this||new Function("return this")()}catch(e){if("object"==typeof window)return window}}(),o.o=function(e,t){return Object.prototype.hasOwnProperty.call(e,t)},function(){var e={826:0,46:0};o.O.j=function(t){return 0===e[t]};var t=function(t,n){var a,i,l=n[0],s=n[1],r=n[2],c=0;if(l.some((function(t){return 0!==e[t]}))){for(a in s)o.o(s,a)&&(o.m[a]=s[a]);if(r)var m=r(o)}for(t&&t(n);c<l.length;c++)i=l[c],o.o(e,i)&&e[i]&&e[i][0](),e[l[c]]=0;return o.O(m)},n=self.webpackChunkanimations_for_blocks=self.webpackChunkanimations_for_blocks||[];n.forEach(t.bind(null,0)),n.push=t.bind(null,n.push.bind(n))}();var a=o.O(void 0,[151,46],(function(){return o(155)}));a=o.O(a)}();