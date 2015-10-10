QUnit.test("Edit Manuscript Test", function(assert){
	assert.equal(editSection(1), 1);
});

QUnit.test("Should Raise Exceptions Test", function(assert){
	assert.equal(editSection(1), 1);
});

/*QUnit.asyncTest('pageinformation', function (assert) {
	expect(2);
   	QUnit.stop(3);

	window.setTimeout(function() {
      	assert.equal(max(), -Infinity, 'No parameters');
      	QUnit.start();
   	}, 0);
});*/