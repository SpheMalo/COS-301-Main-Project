/*This test is for the setting up of the Qunit framework*/

Qunit.test("register test", function(assert){
	//ok(registration, "exists")
	assert.equal(registration, "exists");
});

/*Qunit.test("register is a function", function(assert){
	ok(typeof registration === 'function', "registration is a function")
});*/