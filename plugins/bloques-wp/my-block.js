wp.blocks.registerBlockType("jacky/border-box",{
    title: "mi bloque con bordes",
    icon: "smiley",
    category: "common",
    attributes:{
        content: {type: "string"},
        color: {type:"string"}
    },
    edit: function(props){
        function updateContent(event){
            props.setAttributes({content: event.target.value })
        }
        return React.createElement("div", null, /*#__PURE__*/React.createElement("h3", null, "Mi Bloque con Bordes"), /*#__PURE__*/React.createElement("input", {
            type: "text",
            value: props.attributes.content,
            onChange: updateContent
          }));
    },
    save: function(props){
        return null
    }
})