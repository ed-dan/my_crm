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
        background: #a9a9a9;
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
        background: #9f9e9e;
        padding: 5px 10px;
        margin: 5px;
    }

</style>


<main>

    <p>Change the number values in the html.</p>
    <section>
        <div class="pieID pie">

        </div>
        <ul class="pieID legend">
            <li>
                <em>Reject</em>
                <span>118</span>
            </li>
            <li>
                <em>Callback</em>
                <span>11</span>
            </li>
            <li>
                <em>Confirm</em>
                <span>18</span>
            </li>
            <li>
                <em>Confirm2</em>
                <span>12</span>
            </li>

        </ul>
    </section>

</main>
{{--<footer>--}}
{{--    An original pen by <a href="https://codepen.io/ejsado/">Eric</a>.--}}
{{--</footer>--}}



<script>
    function sliceSize(dataNum, dataTotal) {
        return (dataNum / dataTotal) * 360;
    }
    function addSlice(sliceSize, pieElement, offset, sliceID, color) {
        $(pieElement).append("<div class='slice "+sliceID+"'><span></span></div>");
        var offset = offset - 1;
        var sizeRotation = -179 + sliceSize;
        $("."+sliceID).css({
            "transform": "rotate("+offset+"deg) translate3d(0,0,0)"
        });
        $("."+sliceID+" span").css({
            "transform"       : "rotate("+sizeRotation+"deg) translate3d(0,0,0)",
            "background-color": color
        });
    }
    function iterateSlices(sliceSize, pieElement, offset, dataCount, sliceCount, color) {
        var sliceID = "s"+dataCount+"-"+sliceCount;
        var maxSize = 179;
        if(sliceSize<=maxSize) {
            addSlice(sliceSize, pieElement, offset, sliceID, color);
        } else {
            addSlice(maxSize, pieElement, offset, sliceID, color);
            iterateSlices(sliceSize-maxSize, pieElement, offset+maxSize, dataCount, sliceCount+1, color);
        }
    }
    function createPie(dataElement, pieElement) {
        var listData = [];
        $(dataElement+" span").each(function() {
            listData.push(Number($(this).html()));
        });
        var listTotal = 0;
        for(var i=0; i<listData.length; i++) {
            listTotal += listData[i];
        }
        var offset = 0;
        var color = [
            "cornflowerblue",
            "orange",
            "olivedrab",
            "tomato",
            "crimson",
            "purple",
            "turquoise",
            "forestgreen",
            "navy",
            "gray"
        ];
        for(var i=0; i<listData.length; i++) {
            var size = sliceSize(listData[i], listTotal);
            iterateSlices(size, pieElement, offset, i, 0, color[i]);
            $(dataElement+" li:nth-child("+(i+1)+")").css("border-color", color[i]);
            offset += size;
        }
    }
    createPie(".pieID.legend", ".pieID.pie");

</script>
