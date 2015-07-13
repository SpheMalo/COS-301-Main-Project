/*module( "attributes", {
teardown: moduleTeardown
});*/

test( "jQuery.propFix integrity test", function() {
expect( 1 );
// This must be maintained and equal jQuery.attrFix when appropriate
// Ensure that accidental or erroneous property
// overwrites don't occur
// This is simply for better code coverage and future proofing.
var props = {/*
"tabindex": "tabIndex",
"readonly": "readOnly",
"for": "htmlFor",
"class": "className",
"maxlength": "maxLength",
"cellspacing": "cellSpacing",
"cellpadding": "cellPadding",
"rowspan": "rowSpan",
"colspan": "colSpan",
"usemap": "useMap",
"frameborder": "frameBorder",
"contenteditable": "contentEditable"*/
};
deepEqual( props, jQuery.propFix, "jQuery.propFix passes integrity check" );
});



