/*This test is for the setting up of the Qunit framework*/

test("register test", function(){
	ok(registration, "exists")
})

test("register is a function", function(){
	ok(typeof registration === 'function', "registration is a function")
})