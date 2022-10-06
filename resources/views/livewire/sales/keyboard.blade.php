<script>
    KioskBoards.init({
        keysArrayOfObjects:[{
            "0":"Q",
            "1":"W",
            "2":"E",
            "3":"R",
            "4":"T",
            "5":"Y",
            "6":"U",
            "7":"I",
            "8":"O",
            "9":"P"
        },{
            "0":"A",
            "1":"S",
            "2":"D",
            "3":"F",
            "4":"G",
            "5":"H",
            "6":"J",
            "7":"K",
            "8":"L",
            "9":"Ñ"
        },{
            "0":"Z",
            "1":"X",
            "2":"C",
            "3":"V",
            "4":"B",
            "5":"N",
            "6":"M",
            "7":"@",
            "8":".",
        }],
        keysJsonUrl : null,

        keysSpecialCharsArrayOfString: ["#","Enter"],

        keysNumpadArrayOfNumbres: [1,2,3,4,5,6,7,8,9,0],
        theme: 'flat',
        language: 'es',
        keysIconSize: '10px',
        keysFontSize: '15px',
    })
    KioskBoard.run('.kioskboard',{});
</script>
