<!DOCTYPE html>
<html>
<head>
	<title>Challenge</title>
	<link rel="stylesheet" href="styles/codemirror.css">
	<link rel="stylesheet" type="text/css" href="styles/dracula.css">
	<link rel="stylesheet" type="text/css" href="styles/show-hint.css">

</head>
<body>
	
	<textarea id="textArea"></textarea>
	<!-- Create a simple CodeMirror instance -->

	<script src="js/javascript.js"></script>
	<script src="js/codemirror.js"></script>
	<script src="js/closetag.js"></script>
	<script src="js/show-hint.js"></script>
	<script src="js/css-hint.js"></script>
	<script src="js/css.js"></script>
	<script src="js/python.js"></script>
	<script src="js/test.js"></script>




	<script>
		//  var myCodeMirror = CodeMirror(document.body, {
		// 	  value: "function myScript(){return 100;}\n",
		// 	  mode:  "javascript"
		// });

		var myCodeMirror = CodeMirror.fromTextArea(document.getElementById('textArea'),{
			mode: "python",
			theme: "dracula",
			lineNumbers: true,
			autoCloseTags: true,
			extraKeys: {"Ctrl-Space": "autocomplete"}

		});
	</script>

<!-- 

HACKEREATH

Name: TestClient

Hostname: http://aptitudetestonline.000webhostapp.com/

Client Id: adc9e581d95ecaf14e205b96744580cfeecc69e2b105.api.hackerearth.com

Client Secret Key: 6687472a8cc588082b7a78333b95925fc968dbdd

JUDGE0
X-Auth-Token: f6583e60-b13b-4228-b554-2eb332ca64e7



 -->

</body>
</html>