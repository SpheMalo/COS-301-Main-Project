/*This test is for the setting up of the Qunit framework*/

QUnit.test("register test", function(assert){
	//ok(registration, "exists")
	function f(){
		assert.equal(registration, registration);
		assert.equal(typeof registration === 'function', true);
	}
	f();
});