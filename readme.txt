=== Easy Digital Downloads - Commission Notes ===
Contributors: sellcomet, mandyjonesmusic
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=LLR26ABB7C39Q
Tags: easy digital downloads, digital, download, downloads, edd, sellcomet, commissions, notes, ecommerce, e-store, eshop, marketplace, vendors, transaction
Requires at least: 4.0
Tested up to: 4.9.2
Stable tag: trunk
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Record commission notes and allow your vendors to easily view them.

== Description ==

**Commission Notes** for Easy Digital Downloads allows you to record and store important notes alongside your commission records. Vendors can view the notes via the `{edd_commissions}` short code, and notes can be recorded automatically when a discount code is applied at the checkout, or when commissions are revoked.

== Use-case Examples ==

Let’s look at some real-world examples of how Commission Notes could potentially be utilised in different scenarios:

* You want to provide your vendors with detailed information relating to how and why the commission record was revoked, including relational data such as the payment and transaction IDs.
* You want to let your vendors view when a discount code was used on an order they receive commissions for, helping them make more sense of the final amount rewarded
* You want to add a commission note when an order looks suspicious or fraudulent, giving your vendors prior warning that the commission may be revoked

== Features ==

* Record commission notes on a per-commission basis
* Store an unlimited number of notes on a per-commission basis
* Automatically record a note, including the payment ID, when an order is refunded
* Automatically record a note containing any discount codes used on the order where commissions were rewarded
* All notes are viewable by your vendors via a responsive, lightweight modal-box on the front-end `{edd_commissions}` short code
* Seamless integration with Easy Digital Downloads and Commissions settings
* Translation-ready and contains a POT file to help get you started translating into your own native language
* Have a specific use-case? Commission Notes includes plenty of developer-ready filters and action hooks to make it possible!
* Developed using the best practices, with security, extensibility, and readability in mind

This plugin requires [Easy Digital Downloads](http://wordpress.org/extend/plugins/easy-digital-downloads/ "Easy Digital Downloads") and [Commissions](https://easydigitaldownloads.com/downloads/commissions/ "Commissions").

== Developers ==

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

== Bugs ==

If you find an issue, let us know [here](https://github.com/davidsherlock/edd-commission-notes/issues?state=open)!

== Support ==

Please visit the [support page](https://wordpress.org/support/plugin/edd-commission-notes) if you need to submit a support request.

== Contributions ==

Anyone is welcome to contribute to Commission Fees.

There are various ways you can contribute:

* Raise an [Issue](https://github.com/davidsherlock/edd-commission-notes/issues) on GitHub
* Send us a Pull Request with your bug fixes and/or new features. Please open an issue beforehand if one does not currently exist.
* Provide feedback and suggestions on [enhancements](https://github.com/davidsherlock/edd-commission-notes/issues?direction=desc&labels=Enhancement&page=1&sort=created&state=open)

== Installation ==

1. Unpack the entire contents of this plugin zip file into your `wp-content/plugins/` folder locally
1. Upload to your site
1. Navigate to `wp-admin/plugins.php` on your site (your WP Admin plugin page)
1. Activate this plugin
1. That's it!

OR you can just install it with WordPress by going to Plugins >> Add New >> and type this plugin's name

== Frequently Asked Questions ==

== Screenshots ==

== Upgrade Notice ==

== Changelog ==

= 1.0.0, January 31, 2018 =
* Initial release
