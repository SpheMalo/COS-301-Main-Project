/*This test is for the setting up of the Qunit framework*/

QUnit.test("register test", function(assert){
	function f(){
			assert.equal(typeof document, 'object');
			assert.equal(typeof ajaxFunction, 'function');
		}
	f();
});