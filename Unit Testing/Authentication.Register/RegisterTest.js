QUnit.test("Register Test", function( assert ) {
	assert.equal(typeof testRegister(), 'string');
	assert.equal(testRegister(), "");
});

QUnit.test("Should throw exception", function( assert ) {
	//assert.equal(typeof testRegister(), 'string');
	assert.equal(testRegister(), "");
});
