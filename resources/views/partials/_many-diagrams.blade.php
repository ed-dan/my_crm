<style>
    @import url(https://fonts.googleapis.com/css?family=Open+Sans:400,700);

    @keyframes bake-pie {
        from {
            transform: rotate(0deg) translate3d(0,0,0);
        }
    }

    body {
        font-family: "Open Sans", Arial;
        background: #EEE;
    }
    main {
        width: 400px;
        margin: 30px auto;
    }
    section {
        margin-top: 30px;
    }
    .pieID {
        display: inline-block;
        vertical-align: top;
    }
    .pie {
        height: 200px;
        width: 200px;
        position: relative;
        margin: 0 30px 30px 0;
    }
    .pie::before {
        content: "";
        display: block;
        position: absolute;
        z-index: 1;
        width: 100px;
        height: 100px;
        background: #EEE;
        border-radius: 50%;
        top: 50px;
        left: 50px;
    }
    .pie::after {
        content: "";
        display: block;
        width: 120px;
        height: 2px;
        background: rgba(0,0,0,0.1);
        border-radius: 50%;
        box-shadow: 0 0 3px 4px rgba(0,0,0,0.1);
        margin: 220px auto;

    }
    .slice {
        position: absolute;
        width: 200px;
        height: 200px;
        clip: rect(0px, 200px, 200px, 100px);
        animation: bake-pie 1s;
    }
    .slice span {
        display: block;
        position: absolute;
        top: 0;
        left: 0;
        background-color: black;
        width: 200px;
        height: 200px;
        border-radius: 50%;
        clip: rect(0px, 200px, 200px, 100px);
    }
    .legend {
        list-style-type: none;
        padding: 0;
        margin: 0;
        background: #FFF;
        padding: 15px;
        font-size: 13px;
        box-shadow: 1px 1px 0 #DDD,
        2px 2px 0 #BBB;
    }
    .legend li {
        width: 110px;
        height: 1.25em;
        margin-bottom: 0.7em;
        padding-left: 0.5em;
        border-left: 1.25em solid black;
    }
    .legend em {
        font-style: normal;
    }
    .legend span {
        float: right;
    }
    footer {
        position: fixed;
        bottom: 0;
        right: 0;
        font-size: 13px;
        background: #DDD;
        padding: 5px 10px;
        margin: 5px;
    }

</style>

<body translate="no">
<div class="wrapper">
    <h1>Answered Questions</h1>
    <div class="pie-charts">
        <div class="pieID--micro-skills pie-chart--wrapper">
            <h2>Micro-Skills</h2>
            <div class="pie-chart">
                <div class="pie-chart__pie"><div class="slice s0-0" style="transform: rotate(-1deg) translate3d(0px, 0px, 0px);"><span style="transform: rotate(0deg) translate3d(0px, 0px, 0px); background-color: olivedrab;"></span></div><div class="slice s0-1" style="transform: rotate(178deg) translate3d(0px, 0px, 0px);"><span style="transform: rotate(-126.88deg) translate3d(0px, 0px, 0px); background-color: olivedrab;"></span></div><div class="slice s1-0" style="transform: rotate(230.12deg) translate3d(0px, 0px, 0px);"><span style="transform: rotate(-50.12deg) translate3d(0px, 0px, 0px); background-color: turquoise;"></span></div></div>
                <ul class="pie-chart__legend">
                    <li style="border-color: olivedrab;"><em>Additive</em><span>642</span></li>
                    <li style="border-color: turquoise;"><em>Multiplicative</em><span>358</span></li>
                </ul>
            </div>
        </div>
        <div class="pieID--categories pie-chart--wrapper">
            <h2>Categories</h2>
            <div class="pie-chart">
                <div class="pie-chart__pie"><div class="slice s0-0" style="transform: rotate(-1deg) translate3d(0px, 0px, 0px);"><span style="transform: rotate(0deg) translate3d(0px, 0px, 0px); background-color: tomato;"></span></div><div class="slice s0-1" style="transform: rotate(178deg) translate3d(0px, 0px, 0px);"><span style="transform: rotate(-81.52deg) translate3d(0px, 0px, 0px); background-color: tomato;"></span></div><div class="slice s1-0" style="transform: rotate(275.48deg) translate3d(0px, 0px, 0px);"><span style="transform: rotate(-95.48deg) translate3d(0px, 0px, 0px); background-color: olivedrab;"></span></div></div>
                <ul class="pie-chart__legend">
                    <li style="border-color: tomato;"><em>Horizontal</em><span>768</span></li>
                    <li style="border-color: olivedrab;"><em>Vertical</em><span>232</span></li>
                </ul>
            </div>
        </div>
        <div class="pieID--operations pie-chart--wrapper">
            <h2>Operations</h2>
            <div class="pie-chart">
                <div class="pie-chart__pie"><div class="slice s0-0" style="transform: rotate(-1deg) translate3d(0px, 0px, 0px);"><span style="transform: rotate(-4.04deg) translate3d(0px, 0px, 0px); background-color: cornflowerblue;"></span></div><div class="slice s1-0" style="transform: rotate(173.96deg) translate3d(0px, 0px, 0px);"><span style="transform: rotate(-122.84deg) translate3d(0px, 0px, 0px); background-color: navy;"></span></div><div class="slice s2-0" style="transform: rotate(230.12deg) translate3d(0px, 0px, 0px);"><span style="transform: rotate(-101.6deg) translate3d(0px, 0px, 0px); background-color: tomato;"></span></div><div class="slice s3-0" style="transform: rotate(307.52deg) translate3d(0px, 0px, 0px);"><span style="transform: rotate(-127.52deg) translate3d(0px, 0px, 0px); background-color: purple;"></span></div></div>
                <ul class="pie-chart__legend">
                    <li style="border-color: cornflowerblue;"><em>Addition</em><span>486</span></li>
                    <li style="border-color: navy;"><em>Subtraction</em><span>156</span></li>
                    <li style="border-color: tomato;"><em>Multiplication</em><span>215</span></li>
                    <li style="border-color: purple;"><em>Division</em><span>143</span></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
{{--<script src="https://codepen.io/MaciejCaputa/pen/EmMooZ.js"></script><a target="_blank" href="https://www.instagram.com/maciej_caputa/" style="text-decoration: none; display: block; position: fixed; bottom: 0px; width: 4rem; height: 4rem; z-index: 100; left: 0px;"><div style="position: absolute; bottom: 0px; color: white; border-bottom: 4rem solid rgb(205, 72, 107); border-right: 4rem solid transparent;"></div><img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/387354/glyph-logo_May2016.png" style="position: absolute; height: 1.87rem; width: auto; bottom: 0.25rem; cursor: pointer; left: 0.25rem; filter: invert(100%);"></a><a target="_blank" href="https://twitter.com/MaciejCaputa" style="text-decoration: none; display: block; position: fixed; bottom: 0px; width: 4rem; height: 4rem; z-index: 100; right: 0px;"><div style="position: absolute; bottom: 0px; color: white; border-bottom: 4rem solid rgb(29, 161, 242); border-left: 4rem solid transparent;"></div><img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/387354/Twitter_Logo_WhiteOnBlue.png" style="position: absolute; height: 1.87rem; width: auto; bottom: 0.25rem; cursor: pointer; right: 0.05rem;"></a>--}}
<script id="rendered-js">
    function sliceSize(dataNum, dataTotal) {
        return dataNum / dataTotal * 360;
    }

    function addSlice(id, sliceSize, pieElement, offset, sliceID, color) {
        $(pieElement).append("<div class='slice " + sliceID + "'><span></span></div>");
        var offset = offset - 1;
        var sizeRotation = -179 + sliceSize;

        $(id + " ." + sliceID).css({
            "transform": "rotate(" + offset + "deg) translate3d(0,0,0)" });


        $(id + " ." + sliceID + " span").css({
            "transform": "rotate(" + sizeRotation + "deg) translate3d(0,0,0)",
            "background-color": color });

    }

    function iterateSlices(id, sliceSize, pieElement, offset, dataCount, sliceCount, color) {
        var
            maxSize = 179,
            sliceID = "s" + dataCount + "-" + sliceCount;

        if (sliceSize <= maxSize) {
            addSlice(id, sliceSize, pieElement, offset, sliceID, color);
        } else {
            addSlice(id, maxSize, pieElement, offset, sliceID, color);
            iterateSlices(id, sliceSize - maxSize, pieElement, offset + maxSize, dataCount, sliceCount + 1, color);
        }
    }

    function createPie(id) {
        var
            listData = [],
            listTotal = 0,
            offset = 0,
            i = 0,
            pieElement = id + " .pie-chart__pie";
        dataElement = id + " .pie-chart__legend";

        color = [
            "cornflowerblue",
            "olivedrab",
            "orange",
            "tomato",
            "crimson",
            "purple",
            "turquoise",
            "forestgreen",
            "navy"];


        color = shuffle(color);

        $(dataElement + " span").each(function () {
            listData.push(Number($(this).html()));
        });

        for (i = 0; i < listData.length; i++) {if (window.CP.shouldStopExecution(0)) break;
            listTotal += listData[i];
        }window.CP.exitedLoop(0);

        for (i = 0; i < listData.length; i++) {if (window.CP.shouldStopExecution(1)) break;
            var size = sliceSize(listData[i], listTotal);
            iterateSlices(id, size, pieElement, offset, i, 0, color[i]);
            $(dataElement + " li:nth-child(" + (i + 1) + ")").css("border-color", color[i]);
            offset += size;
        }window.CP.exitedLoop(1);
    }

    function shuffle(a) {
        var j, x, i;
        for (i = a.length; i; i--) {if (window.CP.shouldStopExecution(2)) break;
            j = Math.floor(Math.random() * i);
            x = a[i - 1];
            a[i - 1] = a[j];
            a[j] = x;
        }window.CP.exitedLoop(2);

        return a;
    }

    function createPieCharts() {
        createPie('.pieID--micro-skills');
        createPie('.pieID--categories');
        createPie('.pieID--operations');
    }

    createPieCharts();
    //# sourceURL=pen.js
</script>





</body>
