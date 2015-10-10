QUnit.test("Login Test", function( assert ) {
	assert.equal(typeof testLogin, 'function');
	assert.equal(typeof actualLoginTest, 'function');
	assert.equal(typeof ajaxLoginFunction, 'function');
	assert.equal(actualLoginTest(), "Success");
});
