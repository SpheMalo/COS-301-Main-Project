QUnit.test("Activate Test", function( assert ) {
	//assert.equal(typeof actualLoginTest(), 'string');
	actualLoginTest();
	assert.equal(typeof testActivate(), 'string');
	
	assert.equal(testActivate(), "activated");
});

QUnit.test("Suspend Test", function( assert ) {
	actualLoginTest();
	assert.equal(typeof testSuspend(), 'string');
	assert.equal(testSuspend(), "suspended");
});

QUnit.test("Delete Test", function( assert ) {
	actualLoginTest();
	assert.equal(typeof testDelete(), 'string');
	assert.equal(testDelete(), "deleted");
});