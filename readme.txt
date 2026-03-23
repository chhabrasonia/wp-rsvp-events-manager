=== WP RSVP Events Manager ===
Contributors: soniachhabra
Tags: events, custom post type, filtering, RSVP, taxonomy
Requires at least: 6.0
Tested up to: 6.5
Requires PHP: 8.0
License: GPLv2 or later

A simple Events Manager plugin with date filtering, RSVP and taxonomy support.

== Description ==

This plugin allows you to:

- Create Events (Custom Post Type)
- Assign Event Types (Taxonomy)
- Add Event Date and Location via meta boxes
- Filter events by date range, event type, and keyword search
- RSVP to events via email links (Yes / No / Maybe)
- Expose event data via REST API
- Manage events from the command line using WP-CLI

== Installation ==

1. Upload the plugin folder to /wp-content/plugins/
2. Activate the plugin from WordPress admin
3. Go to Events in the admin menu to create events

== Shortcode Usage ==

Place this shortcode on any page to display the event listing with filters:

  [event_list]

The shortcode includes:
- Keyword search
- Date range filter (start / end)
- Event type dropdown filter

== RSVP ==

When an event is published, all registered users receive an email with
Yes / No / Maybe links. Clicking a link records their RSVP in the database
and redirects back to the event page.

== REST API ==

Events are available at:

  GET /wp-json/events/v1/list

Returns: id, title, date, location for all published events.

== WP-CLI Commands ==

  wp event generate              — Create 1 sample event

== Filter Parameters ==

The [event_list] shortcode reads these GET parameters from the URL:

  ?search=keyword      — keyword search
  ?start=YYYY-MM-DD    — filter from date
  ?end=YYYY-MM-DD      — filter to date
  ?type=slug           — filter by event type slug

== Localization ==

The plugin is fully translatable. A POT template and a sample Hindi (hi_IN)
translation are included in the /languages/ folder.

== Changelog ==

= 1.0.0 =
- Initial release

== License ==

GPLv2 or later
