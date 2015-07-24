QUnit.test("Functions Recognized", function( assert ) {
	assert.equal(typeof testLogin, 'function');
	assert.equal(typeof actualLoginTest, 'function');
	assert.equal(typeof ajaxLoginFunction, 'function');
});


QUnit.test("User Login Test", function(assert){
	assert.equal(actualLoginTest(), "Success");
});

QUnit.test("Should Raise Exceptions Test", function(assert){
	assert.equal("Success", actualLoginTest());
});

