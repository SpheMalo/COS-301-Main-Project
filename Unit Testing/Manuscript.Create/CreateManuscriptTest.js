QUnit.test("Create Manuscript Test", function(assert){
	assert.equal(pageinformation(), "Success");
});

QUnit.test("Should Raise Exceptions Test", function(assert){
	assert.equal("Success", pageinformation());
});

/*QUnit.asyncTest('pageinformation', function (assert) {
   expect(2);
   QUnit.stop(3);
 
   window.setTimeout(function() {
      assert.equal(max(), -Infinity, 'No parameters');
      QUnit.start();
   }, 0);
});*/