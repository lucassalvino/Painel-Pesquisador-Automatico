@extends('layouts.admin')
@section('title', 'Sobre')

@section('content')

<div class="d-flex flex-column">
    <h1>Sobre</h1>
    <h3>O que é?</h3>
    <p>
        Plataforma que a partir de uma base de artigos alimentada pelos usuários da plataforma, tenta obter conhecimento a partir da
        organização e análise dos mesmos.
    </p>
    <p>
        A organização é ralizada com a utilização de grafos de conhecimento.<br>
        A análise é realizada com inteligência artificial (encoders e autoencoders)
    </p>
    <h3>Como funciona</h3>
    <p>
        Todo o conhecimento é criado a partir de iterações e ações dos usuários da plataforma.<br>
        Usuários se registram  para ajudar a alimentar sua base de dados, realizar pesquisas e doar poder computacional.
    </p>
    <ul>
        <li><b>Usuário 'comum':</b> Somente acessa a plataforma para realizar pesquisas. Sua contribuição se restringe somente a avaliar as suposições criadas pela inteligência artifical (IA)*</li>
        <li><b>Usuário 'Alimentador':</b> Esse usuário ajuda a alimentar a base cadastrando artigos</li>
        <li><b>Usuário 'Computador':</b> Esse usuário ajuda a alimentar a base com poder computacional. O mesmo baixa o cliente de processamento para acessar a base de artigos e o Grafo de Conhecimento**</li>
    </ul>
    <p>
    Abaixo segue diagrama com o processo de geração de conhecimento proposto pela plataforma:
    </p>
    <p>
    <small> <strong>*</strong> Suposições são conclusões criadas pela IA a partir da análise do grafo de conhecimento e das avaliações das mesmas.</small>
    </p>
    <p>
    <small> <strong>**</strong> Grafo de conhecimento é uma estrutura que armazena informações correlacionando conceitos, eventos e processo.</small>
    </p>

    <div class="d-flex">
      <div id="containerdiagrama" style="flex-grow: 1; height: 750px; background-color: #282c34;"></div>
    </div>
</div>

<script>
function init() {
    var $ = go.GraphObject.make;
    myDiagram =
      $(go.Diagram, "containerdiagrama",
        {
          "LinkDrawn": showLinkLabel,
          "LinkRelinked": showLinkLabel,
          "undoManager.isEnabled": true
        });

    myDiagram.addDiagramListener("Modified", function(e) {
      var button = document.getElementById("SaveButton");
      if (button) button.disabled = !myDiagram.isModified;
      var idx = document.title.indexOf("*");
      if (myDiagram.isModified) {
        if (idx < 0) document.title += "*";
      } else {
        if (idx >= 0) document.title = document.title.substr(0, idx);
      }
    });

    function nodeStyle() {
      return [
        new go.Binding("location", "loc", go.Point.parse).makeTwoWay(go.Point.stringify),
        {
          locationSpot: go.Spot.Center
        }
      ];
    }

    function makePort(name, align, spot, output, input) {
      var horizontal = align.equals(go.Spot.Top) || align.equals(go.Spot.Bottom);
      return $(go.Shape,
        {
          fill: "transparent",
          strokeWidth: 0,
          width: horizontal ? NaN : 8,
          height: !horizontal ? NaN : 8,
          alignment: align,
          stretch: (horizontal ? go.GraphObject.Horizontal : go.GraphObject.Vertical),
          portId: name,
          fromSpot: spot,
          fromLinkable: output,
          toSpot: spot,
          toLinkable: input,
          cursor: "auto",
          mouseEnter: function(e, port) {
            if (!e.diagram.isReadOnly) port.fill = "rgba(255,0,255,0.5)";
          },
          mouseLeave: function(e, port) {
            port.fill = "transparent";
          }
        });
    }

    function textStyle() {
      return {
        font: "bold 11pt Lato, Helvetica, Arial, sans-serif",
        stroke: "#F8F8F8"
      }
    }

    myDiagram.nodeTemplateMap.add("",
      $(go.Node, "Table", nodeStyle(),
        $(go.Panel, "Auto",
          $(go.Shape, "Rectangle",
            { fill: "#282c34", stroke: "#00A9C9", strokeWidth: 3.5 },
            new go.Binding("figure", "figure")),
          $(go.TextBlock, textStyle(),
            {
              margin: 8,
              maxSize: new go.Size(160, NaN),
              wrap: go.TextBlock.WrapFit,
              editable: false
            },
            new go.Binding("text").makeTwoWay())
        ),
        makePort("T", go.Spot.Top, go.Spot.TopSide, false, false),
        makePort("L", go.Spot.Left, go.Spot.LeftSide, false, false),
        makePort("R", go.Spot.Right, go.Spot.RightSide, false, false),
        makePort("B", go.Spot.Bottom, go.Spot.BottomSide, false, false)
      ));

    myDiagram.nodeTemplateMap.add("Conditional",
      $(go.Node, "Table", nodeStyle(),
        $(go.Panel, "Auto",
          $(go.Shape, "Diamond",
            { fill: "#282c34", stroke: "#00A9C9", strokeWidth: 3.5 },
            new go.Binding("figure", "figure")),
          $(go.TextBlock, textStyle(),
            {
              margin: 8,
              maxSize: new go.Size(160, NaN),
              wrap: go.TextBlock.WrapFit,
              editable: false
            },
            new go.Binding("text").makeTwoWay())
        ),
        makePort("T", go.Spot.Top, go.Spot.Top, false, false),
        makePort("L", go.Spot.Left, go.Spot.Left, false, false),
        makePort("R", go.Spot.Right, go.Spot.Right, false, false),
        makePort("B", go.Spot.Bottom, go.Spot.Bottom, false, false)
      ));

    myDiagram.nodeTemplateMap.add("Start",
      $(go.Node, "Table", nodeStyle(),
        $(go.Panel, "Auto",
         $(go.Shape, "Rectangle",
            { fill: "#282c34", stroke: "#09d3ac", strokeWidth: 3.5 },
            new go.Binding("figure", "figure")),
          //$(go.Shape, "Rectangle", { desiredSize: new go.Size(NaN, NaN), fill: "#282c34", stroke: "#09d3ac", strokeWidth: 3.5 }),
          $(go.TextBlock, "Start", textStyle(),
            {
              margin: 8,
              maxSize: new go.Size(160, NaN),
              wrap: go.TextBlock.WrapFit,
              editable: false
            },
            new go.Binding("text"))
        ),
        makePort("L", go.Spot.Left, go.Spot.Left, false, false),
        makePort("R", go.Spot.Right, go.Spot.Right, false, false),
        makePort("B", go.Spot.Bottom, go.Spot.Bottom, false, false)
      ));

    myDiagram.nodeTemplateMap.add("End",
      $(go.Node, "Table", nodeStyle(),
        $(go.Panel, "Spot",
          $(go.Shape, "Circle",
            { desiredSize: new go.Size(60, 60), fill: "#282c34", stroke: "#DC3C00", strokeWidth: 3.5 }),
          $(go.TextBlock, "End", textStyle(),
            new go.Binding("text"))
        ),
        makePort("T", go.Spot.Top, go.Spot.Top, false, false),
        makePort("L", go.Spot.Left, go.Spot.Left, false, false),
        makePort("R", go.Spot.Right, go.Spot.Right, false, false)
      ));

    
    go.Shape.defineFigureGenerator("File", function(shape, w, h) {
      var geo = new go.Geometry();
      var fig = new go.PathFigure(0, 0, true); // starting point
      geo.add(fig);
      fig.add(new go.PathSegment(go.PathSegment.Line, .75 * w, 0));
      fig.add(new go.PathSegment(go.PathSegment.Line, w, .25 * h));
      fig.add(new go.PathSegment(go.PathSegment.Line, w, h));
      fig.add(new go.PathSegment(go.PathSegment.Line, 0, h).close());
      var fig2 = new go.PathFigure(.75 * w, 0, false);
      geo.add(fig2);
      fig2.add(new go.PathSegment(go.PathSegment.Line, .75 * w, .25 * h));
      fig2.add(new go.PathSegment(go.PathSegment.Line, w, .25 * h));
      geo.spot1 = new go.Spot(0, .25);
      geo.spot2 = go.Spot.BottomRight;
      return geo;
    });

    myDiagram.nodeTemplateMap.add("Comment",
      $(go.Node, "Auto", nodeStyle(),
        $(go.Shape, "File",
          { fill: "#282c34", stroke: "#DEE0A3", strokeWidth: 3 }),
        $(go.TextBlock, textStyle(),
          {
            margin: 8,
            maxSize: new go.Size(200, NaN),
            wrap: go.TextBlock.WrapFit,
            textAlign: "center",
            editable: false
          },
          new go.Binding("text").makeTwoWay())
      ));
    myDiagram.linkTemplate =
      $(go.Link,
        {
          routing: go.Link.AvoidsNodes,
          curve: go.Link.JumpOver,
          corner: 5, toShortLength: 4,
          relinkableFrom: true,
          relinkableTo: true,
          reshapable: true,
          resegmentable: true,
          mouseEnter: function(e, link) { link.findObject("HIGHLIGHT").stroke = "rgba(30,144,255,0.2)"; },
          mouseLeave: function(e, link) { link.findObject("HIGHLIGHT").stroke = "transparent"; },
          selectionAdorned: false
        },
        new go.Binding("points").makeTwoWay(),
        $(go.Shape,
          { isPanelMain: true, strokeWidth: 8, stroke: "transparent", name: "HIGHLIGHT" }),
        $(go.Shape,
          { isPanelMain: true, stroke: "gray", strokeWidth: 2 },
          new go.Binding("stroke", "isSelected", function(sel) { return sel ? "dodgerblue" : "gray"; }).ofObject()),
        $(go.Shape,
          { toArrow: "standard", strokeWidth: 0, fill: "gray" }),
        $(go.Panel, "Auto",
          { visible: false, name: "LABEL", segmentIndex: 2, segmentFraction: 0.5 },
          new go.Binding("visible", "visible").makeTwoWay(),
          $(go.Shape, "RoundedRectangle",
            { fill: "#F8F8F8", strokeWidth: 0 }),
          $(go.TextBlock, "Yes",
            {
              textAlign: "center",
              font: "10pt helvetica, arial, sans-serif",
              stroke: "#333333",
              editable: true
            },
            new go.Binding("text").makeTwoWay())
        )
      );
    function showLinkLabel(e) {
      var label = e.subject.findObject("LABEL");
      if (label !== null) label.visible = (e.subject.fromNode.data.category === "Conditional");
    }
    myDiagram.toolManager.linkingTool.temporaryLink.routing = go.Link.Orthogonal;
    myDiagram.toolManager.relinkingTool.temporaryLink.routing = go.Link.Orthogonal;
    load();
    function animateFadeDown(e) {
      var diagram = e.diagram;
      var animation = new go.Animation();
      animation.isViewportUnconstrained = true;
      animation.easing = go.Animation.EaseOutExpo;
      animation.duration = 900;
      animation.add(diagram, 'position', diagram.position.copy().offset(0, 200), diagram.position);
      animation.add(diagram, 'opacity', 0, 1);
      animation.start();
    }

  } 


  function load() {
    myDiagram.model = go.Model.fromJson(`
        { "class": "go.GraphLinksModel",
        "linkFromPortIdProperty": "fromPort",
        "linkToPortIdProperty": "toPort",
        "nodeDataArray": [

        {"key":0, "category":"Start", "loc":"0 380", "text":"Usuários criam conteúdos cadastrando artigos"},
        {"key":1, "loc":"200 380", "text":"Usuário instala cliente computacional"},
        {"key":2, "loc":"200 270", "text":"Cliente computacional baixa novos artigos"},
        {"key":3, "loc":"200 150", "text":"Novas arestas e vertices de conhecimentos são computados"},
        {"key":4, "category":"Start", "loc":"200 50", "text":"Pesquisa simplificada"},
        {"key":5, "loc":"450 380", "text":"Processamento IA"},
        {"key":6, "loc":"450 480", "text":"Novas arestas e vertices de suposições são computados"},
        {"key":7, "category":"Start", "loc":"192 597", "text":"Pesquisa inteligente"},
        {"key":8, "loc":"451 617", "text":"Avaliações das suposições"}
        ],
        
        "linkDataArray": [
            {"from":0, "to":1},
            {"from":1, "to":2},
            {"from":2, "to":3},
            {"from":0, "to":4},
            {"from":3, "to":4},
            {"from":4, "to":5, "fromPort":"R"},
            {"from":3, "to":5, "toPort":"T"},
            {"from":1, "to":5},
            {"from":5, "to":6},
            {"from":6, "to":7},
            {"from":7, "to":8, "fromPort":"B"},
            {"from":8, "to":5, "fromPort":"R", "toPort":"R"}
        ]}
    `);
  }
  init();
</script>
@stop