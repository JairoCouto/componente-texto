$(function() {
   /**
    * Formatação do TINY + Layout A4
    */
   
   // RULER
const CLASS_RULER = "document-ruler";
const RULER_PAGEBREAK_CLASS = "mce-ruler-pagebreak";
const RULER_SHORTCUT = "Meta+Q";
const PX_RULER = 3.78; // 3.779527559
const PADDING_RULER = 13; // Em Milimetros
const FORMAT = { width: 210, height: 297 }; // A4 210, 297
const HEIGHT = FORMAT.height * PX_RULER;
const PADDING_MARGIN_LINE_TOP = 45;
const PADDING_MARGIN_LINE_BOTTOM = 45;
const STYLE_RULER = `
 html.${CLASS_RULER}{
   background: #b5b5b5;
   padding: 0;
   background-image: url(data:image/svg+xml;utf8,%3Csvg%20width%3D%22100%25%22%20height%3D%22${
     FORMAT.height
   }mm%22%20version%3D%221.1%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%3E%3Cline%20x1%3D%220%22%20y1%3D%22${
  FORMAT.height
}mm%22%20x2%3D%22100%25%22%20y2%3D%22${
  FORMAT.height
}mm%22%20stroke%3D%22%23${"737373"}%22%20height%3D%221px%22%2F%3E%3C%2Fsvg%3E);
   background-repeat: repeat-y;
   background-position: 0 0;
 }
 html.${CLASS_RULER} body{
   padding: 0 ${PADDING_RULER}mm !important;
   padding-top: ${PADDING_RULER}mm !important;
   margin: 0 auto !important;
   background-image: url(data:image/svg+xml;utf8,%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20width%3D%22${
     FORMAT.width
   }mm%22%20height%3D%22${FORMAT.height}mm%22%3E%3Crect%20width%3D%22${
  FORMAT.width
}mm%22%20height%3D%22${
  FORMAT.height
}mm%22%20style%3D%22fill%3A%23fff%22%2F%3E%3Cline%20x1%3D%220%22%20y1%3D%22100%25%22%20x2%3D%22100%25%22%20y2%3D%22100%25%22%20stroke%3D%22%23737373%22%20height%3D%221px%22%2F%3E%3Cline%20x1%3D%22${PADDING_RULER}mm%22%20y1%3D%220%22%20x2%3D%22${PADDING_RULER}mm%22%20y2%3D%22100%25%22%20stroke%3D%22%230168e1%22%20height%3D%221px%22%20stroke-dasharray%3D%225%2C5%22%2F%3E%3Cline%20x1%3D%22${FORMAT.width -
  PADDING_RULER}mm%22%20y1%3D%220%22%20x2%3D%22${FORMAT.width -
  PADDING_RULER}mm%22%20y2%3D%22100%25%22%20stroke%3D%22%230168e1%22%20height%3D%221px%22%20stroke-dasharray%3D%225%2C5%22%2F%3E%3Cline%20x1%3D%220%22%20y1%3D%22${PADDING_MARGIN_LINE_TOP}mm%22%20x2%3D%22100%25%22%20y2%3D%22${PADDING_MARGIN_LINE_TOP}mm%22%20stroke%3D%22%230168e1%22%20height%3D%221px%22%20stroke-dasharray%3D%225%2C5%22%2F%3E%3Cline%20x1%3D%220%22%20y1%3D%22${FORMAT.height -
    PADDING_MARGIN_LINE_BOTTOM}mm%22%20x2%3D%22100%25%22%20y2%3D%22${FORMAT.height -
    PADDING_MARGIN_LINE_BOTTOM}mm%22%20stroke%3D%22%230168e1%22%20height%3D%221px%22%20stroke-dasharray%3D%225%2C5%22%2F%3E%3C%2Fsvg%3E);
   background-repeat: repeat-y;
   background-position: 0 0;
   width: ${FORMAT.width}mm;
   min-height: ${FORMAT.height}mm !important;
   box-sizing: border-box;
   box-shadow: 4px 4px 13px -3px #3c3c3c;
   -webkit-box-shadow: 4px 4px 13px -3px #3c3c3c;
 }
 html.${CLASS_RULER} .${RULER_PAGEBREAK_CLASS}{
   margin-top: ${PADDING_RULER}mm;
   margin-bottom: ${PADDING_RULER}mm;
   margin-left: -${PADDING_RULER}mm;
   width: calc(100% + ${2 * PADDING_RULER}mm);
   border: 0;
   height: 1px;
   background: #5a8ecb;
 }

 @media print {
   @page {
     size: ${FORMAT.width}mm ${FORMAT.height}mm;
     margin: ${PADDING_RULER}mm !important;
     counter-increment: page
   }
   html.${CLASS_RULER}, html.${CLASS_RULER} body {
     background: transparent;
     box-shadow: none
   }
   html.${CLASS_RULER} body {
     padding: 0 !important;
     width: 100%;
     font-size: 13px;
     font-family: Helvetica,Arial,sans-serif !important;
     font-style: normal;
     letter-spacing: 0
   }
   html.${CLASS_RULER} .${RULER_PAGEBREAK_CLASS}{
     margin: 0 !important;
     height: 0 !important
   }
 }
`;

function debounce(fn, wait = 250, immediate) {
  let timeout;

  function debounced(/* ...args */) {
    const later = () => {
      timeout = void 0;
      if (immediate !== true) {
        fn.apply(this, arguments);
      }
    };

    clearTimeout(timeout);
    if (immediate === true && timeout === void 0) {
      fn.apply(this, arguments);
    }
    timeout = setTimeout(later, wait);
  }

  debounced.cancel = () => {
    clearTimeout(timeout);
  };

  return debounced;
}

function createStyle(style, doc) {
  const tag = doc.createElement("style");
  tag.innerHTML = style;
  doc.head.appendChild(tag);
}
const pluginManager = tinymce.util.Tools.resolve("tinymce.PluginManager");

function pluginRuler(editor) {
  if (editor.settings.ruler !== true) {
    return void 0;
  }
  const tinyEnv = window.tinymce.util.Tools.resolve("tinymce.Env");

  const FilterContent = {
    getPageBreakClass() {
      return RULER_PAGEBREAK_CLASS;
    },
    getPlaceholderHtml() {
      return (
        '<img src="' +
        tinyEnv.transparentSrc +
        '" class="' +
        this.getPageBreakClass() +
        '" data-mce-resize="false" data-mce-placeholder />'
      );
    }
  };

  const Settings = {
    getSeparatorHtml() {
      return editor.getParam("pagebreak_separator", "<!-- ruler-pagebreak -->"); // <!-- pagebreak -->
    },
    shouldSplitBlock() {
      return editor.getParam("pagebreak_split_block", false);
    }
  };

  const separatorHtml = Settings.getSeparatorHtml(editor);
  var pageBreakSeparatorRegExp = new RegExp(
    separatorHtml.replace(/[\?\.\*\[\]\(\)\{\}\+\^\$\:]/g, function(a) {
      return "\\" + a;
    }),
    "gi"
  );
  editor.on("BeforeSetContent", function(e) {
    e.content = e.content.replace(
      pageBreakSeparatorRegExp,
      FilterContent.getPlaceholderHtml()
    );
  });
  editor.on("PreInit", function() {
    editor.serializer.addNodeFilter("img", function(nodes) {
      var i = nodes.length,
        node,
        className;
      while (i--) {
        node = nodes[i];
        className = node.attr("class");
        if (
          className &&
          className.indexOf(FilterContent.getPageBreakClass()) !== -1
        ) {
          const parentNode = node.parent;
          if (
            editor.schema.getBlockElements()[parentNode.name] &&
            Settings.shouldSplitBlock(editor)
          ) {
            parentNode.type = 3;
            parentNode.value = separatorHtml;
            parentNode.raw = true;
            node.remove();
            continue;
          }
          node.type = 3;
          node.value = separatorHtml;
          node.raw = true;
        }
      }
    });
  });

  editor.on("ResolveName", function(e) {
    if (
      e.target.nodeName === "IMG" &&
      editor.dom.hasClass(e.target, FilterContent.getPageBreakClass())
    ) {
      e.name = "pagebreak";
    }
  });


  /** Validar Chamada - Não encontrada no debug */
  editor.addCommand("mceRulerPageBreak", function() {
    if (editor.settings.pagebreak_split_block) {
      editor.insertContent("<p>" + FilterContent.getPlaceholderHtml() + "</p>");
    } else {
      editor.insertContent(FilterContent.getPlaceholderHtml());
    }
  });

  editor.addCommand("mceRulerRecalculate", function() {
    const $document = editor.getDoc();
    const $breaks = $document.querySelectorAll(`.${RULER_PAGEBREAK_CLASS}`);

    for (let i = 0; i < $breaks.length; i++) {
      const $element = $breaks[i];
      const $parent = $element.parentElement;
      const offsetTop = $element.offsetTop;
      const top = HEIGHT * (i + 1);
      if (top >= offsetTop) {
        $parent.style.marginTop =
          ~~(top - (offsetTop - $parent.style.marginTop.replace("px", ""))) +
          "px";
      }
    }
  });

  editor.addShortcut(RULER_SHORTCUT, "", "mceRulerPageBreak");

  editor.on("init", e => {
    const $document = editor.getDoc();
    createStyle(STYLE_RULER, $document);
    const documentElement = $document.documentElement;
    const hasRuler = documentElement.classList.contains(CLASS_RULER);

    if (hasRuler === false) {
      documentElement.classList.add(CLASS_RULER);
    }
  });

  const recalculate = debounce(() => {
    editor.execCommand("mceRulerRecalculate");
  }, 100);

  editor.on("NodeChange", e => {
    recalculate();
  });
}

tinymce.PluginManager.add("ruler", pluginRuler);

tinymce.init({
  selector: "#editor",
  language: 'pt_BR',
  height: 600,
  menubar: true,
  plugins: [
    "image",
    "autolink", 
    "lists",
    "media",
    "table",
    "pagebreak", 
    "preview",
    "directionality",
    "ruler",
  ],
  ruler: true,
  menubar: 'edit format tools',
  toolbar:
    "fontselect | fontsizeselect | forecolor backcolor | bold italic underline alignleft aligncenter alignright alignjustify | undo redo | image editimage table tableofcontents | outdent indent | ltr rtl | numlist bullist | print |listMenuCustom ",
  font_size_formats: '8pt 10pt 12pt 14pt 16pt 18pt 24pt 36pt 48pt',
  line_height_formats: '1 1.2 1.4 1.6 2',
  font_formats: "Andale Mono=andale mono,times; Arial=arial,helvetica,sans-serif; Arial Black=arial black,avant garde; Book Antiqua=book antiqua,palatino; Comic Sans MS=comic sans ms,sans-serif; Courier New=courier new,courier; Georgia=georgia,palatino; Helvetica=helvetica; Impact=impact,chicago; Symbol=symbol; Tahoma=tahoma,arial,helvetica,sans-serif; Terminal=terminal,monaco; Times New Roman=times new roman,times; Trebuchet MS=trebuchet ms,geneva; Verdana=verdana,geneva; Webdings=webdings; Wingdings=wingdings,zapf dingbats",
  
  contextmenu: "image imagetools table math", // No usar link, porque no funcionará con spellchecker
  content_css: [
    "//fonts.googleapis.com/css?family=Lato:300,300i,400,400i",
    "//www.tiny.cloud/css/codepen.min.css"
  ],
  content_style: `
  .mce-content-body p {
    margin: 0
  }
  #tinymce.mce-content-body {
    font-size: 13px;
    font-family: Arial,sans-serif !important;
    font-style: normal;
    letter-spacing: 0;
    color: #262626;
    margin: 8px
  }
  figure {
    outline: 3px solid #dedede;
    position: relative;
    display: inline-block
  }
  figure:hover {
    outline-color: #ffc83d
  }
  figure > figcaption {
    color: #333;
    background-color: #f7f7f7;
    text-align: center
  }
  `,

  setup: (editor) => {

    const name =  () => '<strong>[nome]</strong>';
    const email = () => '<strong>[email]</strong>';
    const telephone = () => '<strong>[telefone]</strong>';
    const environmentalLicense = () => '<strong>[licenca_ambiental]</strong>';
    const dueDate = () => '<strong>[data_vencimento]</strong>';
    const applicationNumber = () => '<strong>[numero_requerimento]</strong>';
    const cpf = () => '<strong>[cpf]</strong>';


    /*
    editor.ui.registry.addButton('meuCustomButton', {
       icon: 'checklist-rtl',
       text: 'Novo Componente',
       onAction: () => {
          editor.insertContent(name)
       }
    });
    */

    editor.ui.registry.addSplitButton('listMenuCustom', {
       text: 'Variáveis',
       onAction: (_) => editor.insertContent(''),
       onItemAction: (buttonApi, value) => editor.insertContent(value),
       fetch: (callback) => {
         const items = [
           {
             type: 'choiceitem',
             text: 'Nome Requerente',
             value: name()
           },
           {
             type: 'choiceitem',
             text: 'E-mail Requerente',
             value: email()
           },
           {
             type: 'choiceitem',
             text: 'Telefone Requerente',
             value: telephone()
           },
           {
             type: 'choiceitem',
             text: 'Licença Ambiental',
             value: environmentalLicense()
           },
           {
             type: 'choiceitem',
             text: 'Data Vencimento',
             value: dueDate()
           },
           {
             type: 'choiceitem',
             text: 'Nº Requerimento',
             value: applicationNumber()
           },
           {
             type: 'choiceitem',
             text: 'CPF',
             value: cpf()
           },
         ];
         callback(items);
       }
     });
    
 }



});



})