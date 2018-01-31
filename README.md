## [Easy Digital Downloads - Commission Notes](https://wordpress.org/plugins/edd-commission-notes/)

**Commission Notes** for Easy Digital Downloads allows you to record and store important notes alongside your commission records. Vendors can view the notes via the `{edd_commissions}` short code, and notes can be recorded automatically when a discount code is applied at the checkout, or when commissions are revoked.

## Use-case Examples

Let’s look at some real-world examples of how Commission Notes could potentially be utilised in different scenarios:

* You want to provide your vendors with detailed information relating to how and why the commission record was revoked, including relational data such as the payment and transaction IDs.
* You want to let your vendors view when a discount code was used on an order they receive commissions for, helping them make more sense of the final amount rewarded
* You want to add a commission note when an order looks suspicious or fraudulent, giving your vendors prior warning that the commission may be revoked

## Features

* Record commission notes on a per-commission basis
* Store an unlimited number of notes on a per-commission basis
* Automatically record a note, including the payment ID, when an order is refunded
* Automatically record a note containing any discount codes used on the order where commissions were rewarded
* All notes are viewable by your vendors via a responsive, lightweight modal-box on the front-end `{edd_commissions}` short code
* Seamless integration with Easy Digital Downloads and Commissions settings
* Translation-ready and contains a POT file to help get you started translating into your own native language
* Have a specific use-case? Commission Notes includes plenty of developer-ready filters and action hooks to make it possible!
* Developed using the best practices, with security, extensibility, and readability in mind

This plugin requires [Easy Digital Downloads](http://wordpress.org/extend/plugins/easy-digital-downloads/) and [Commissions](https://easydigitaldownloads.com/downloads/commissions/).

## Developers

Commission Notes was developed with developers and third party integrations in mind, here are a few examples of how to use the `EDDC_Notes` class.

**get_notes()**

Get the parsed notes for a commission as an array.

~~~~
$notes = new EDDC_Notes( $commission->id );
$notes->get_notes();
~~~~

**add_note( $note = '' )**

Add a note to the commission record. Returns the new note if added successfully, false otherwise.

~~~~
$notes = new EDDC_Notes( $commission->id );
$notes->add_note( 'Hello Friend' );
~~~~

**get_notes_count()**

Get the total number of notes we have after parsing.

~~~~
$notes = new EDDC_Notes( $commission->id );
$notes->get_notes_count;
~~~~

## Installation

For detailed setup instructions, visit the official [Documentation](https://sellcomet.com) page.

1. You can clone the GitHub repository: `https://github.com/davidsherlock/edd-commission-notes.git`
2. Or download it directly as a ZIP file: `https://github.com/davidsherlock/edd-commission-notes/archive/master.zip`

This will download the latest developer copy of Commission Notes.

## Bugs

If you find an issue, let us know [here](https://github.com/davidsherlock/edd-commission-notes/issues?state=open)!

## Support

This is a developer's portal for Commission Notes and should _not_ be used for support. Please visit the [support page](https://wordpress.org/support/plugin/edd-commission-notes) if you need to submit a support request.

## Contributions

Anyone is welcome to contribute to Commission Notes.

There are various ways you can contribute:

1. Raise an [Issue](https://github.com/davidsherlock/edd-commission-notes/issues) on GitHub
2. Send us a Pull Request with your bug fixes and/or new features. Please open an issue before-hand if one does not currently exist.
3. Provide feedback and suggestions on [enhancements](https://github.com/davidsherlock/edd-commission-notes/issues?direction=desc&labels=Enhancement&page=1&sort=created&state=open)
