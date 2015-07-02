/*This test is for the setting up of the Qunit framework*/

QUnit.test("register test", function(assert){
	//ok(registration, "exists")
	function f(){
		//testing the type a variable
		assert.equal(typeof registration === 'function', true);
		//testing whether your function returns the expected value
		assert.equal(multiply(2,2), 4);
		//testing whether HTML elements are as expected
		assert.equal(document.getElementById("result").innerHTML, "4");
	}
	f();
});