=== MadTek Entrusans (tm) IDS client ===
Contributors: jeemadtekcom
Tags: Intrusion Detection System, Website Security, File Integrity, FIM, IDS, Security
Requires at least: 4.7.7
Tested up to: 5.2.2
Stable tag: 2.0.6
Requires PHP: 5.6
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

== Description ==

Effective website security requires a combination of tools and best practices to operate WordPress safely on today’s internet. MadTek’s Entrusans IDS security plugin adds tamper-resistance to your security tool set.

Sophisticated hackers scan WordPress websites 24X7 looking for vulnerabilities and they know how to delete or disable security plugins to avoid detection. Whether a breach is due to a Zero-Day attack or a known vulnerability, once hackers gain access to your website, they own it.

Tamper-resistance is essential to expose hackers who disable your website’s security plugins. Until you remove all malicious code and remediate all malicious file deletions or changes your website remains compromised.

MadTek developed the Entrusans IDS plugin to help WordPress website owners restore their websites quickly after a breach. Remediating a hacked website can be a complex and costly forensic job. The Entrusans system gives you the tamper-resistant file change history you need to quickly identify deleted, added and changed files. MadTek encrypts and stores your file-change data on remote servers denying hackers the ability to go undetected.

If you have a mission-critical website e.g. eCommerce, you need to know ASAP if a hacker penetrates your website.

== Installation ==

=== Manual Install ===

1. Download the madtek-entrusans.zip file from the link in the order complete email or from the account download webpage at http://services.madtek.com. Login is required to reach the download page.
2. Create the directory madtek-entrusans in the wp-content/plugins directory.
3. Upload madtek-entrusans plugin files to the /wp-content/plugins/madtek-entrusans directory.
4. Go to the Plugins screen on the Wordpress dashboard and find the newly uploaded Entrusans IDS plugin.
5. Click Activate under the Entrusans IDS plugin.
6. Following successful Wordpress activation find the Entrusans IDS menu item on the left navigation menu of the Wordpress dashboard.
7. Click the Entrusans IDS menu item and when presented with the activation form enter the license key and email address from the order confirmation email received following purchase.
8. Click the activate button.
9. A First Poll email will signal the site has successfully been scanned for the first time.

=== Wordpress Dashboard Install ===

1. Download the madtek-entrusans.zip file from the link in the order complete email or from the account download webpage at http://services.madtek.com. Login is required to reach the download page.
2. Proceed through the standard Wordpress new plugin install steps in the Wordpress plugins screen.
3. Find the newly uploaded Entrusans IDS plugin in the list of plugins.
4. Activate the plugin via the Activate link under the Entrusans IDS plugin entry.
5. Following successful Wordpress activation find the Entrusans IDS menu item on the left navigation menu of the Wordpress dashboard.
6. Click the Entrusans IDS menu item and when presented with the activation form enter the license key and email address from the order confirmation email received following purchase.
7. When presented with the activation form enter the license key and email address from the
   the email received following purchase.
8. Click the activate button.
9. A First Poll email will signal the site has successfully been scanned for the first time.

== Frequently Asked Questions ==

= What does tamper resistant mean? =

Tamper resistant means that a website owner employs extra measures to detect malicious changes to their website. Malicious changes to websites can
be covered up even with security plugins installed. Entrusans IDS stores file change history off-site. To go undetected hackers need access to file change history to cover their tracks.

= Does Entrusans IDS correct any problems it finds? =

Entrusans IDS does not correct problems. Entrusans IDS captures file change history and uses that history to detect changes on a website for analysis. The website owner will determine if the changes to the website are legitimate or malicious.

= Why are there two steps in activation? =

The first step is to activate the plugin from the Wordpress plugin screen.  The second activation is to
establish contact with the Entrusans IDS server to initiate monitoring and the capture
of file system snapshots.

= What happens when a scan fails? =

Entrusans IDS scans are subject to time out for many reasons including the owner's website could be offline, there could be a network failure or a hacker could have deleted the Entrusans IDS client. The Entrusans IDS scanner retries in the event of a time out and after successive failures notifies the website owner via email that the scans are failing.

= If I do not receive an email does that mean I’m OK? =

Entrusans IDS only sends emails if there are changes to files on your website.

= How often does the Entrusans IDS scan? =

Every 24 hours.

= Does this plugin work with WPMU? =

Entrusans IDS supports any PHP based website. The pricing model for the Entrusans IDS is based on the number of domains associated with a multi-site web installation.

== Screenshots ==

1. Change Summary report shows high level activity
2. New Files report lists all new files since last scan
3. Changed Files report lists files whose content has changed since last scan
4. Deleted Files report lists files that have been removed since last scan
5. Touched Files report lists files whose timestamp has changed

== Changelog ==


= 2.0.6 - June 22, 2019 =
* Update testing status to Wordpress 5.2.2

= 2.0.5 - March 5, 2019 =
* Updates to version lables

= 2.0.4 - March 2, 2019 =
* Updates to version lables

= 2.0.3 - February 28, 2019 =
* Updates to use Wordpress email sanitation and removal of no longer needed file after API refinement

= 2.0.2 - February 26, 2019 =
* Updates to fix invalid activation error messages

= 2.0.1 - February 24, 2019 =
* Updates to refine Wordpress API

= 2.0.0 - February 23, 2019 =
* Updates to add Wordpress API infrastructure as a means to support external requests to the Entrusans plugin that are in accordance with Wordpress security standards

= 1.6.2 - February 2, 2019 =
* Updates to harden data input and exchange interfaces
* Updates to move location of plugin specific operational data out of plugin directory
* Updates to make class names less generic to avoid naming collisions
* Updates to documentation
* Updates to messaging on activation

= 1.5.12 - December 24, 2018 =
* Include .htaccess as an extension to hash
* Updates to documentation
* Update messaging on activation

= 1.5.11 =
* Update activation domain name

= 1.5.10 =
* Fix URLs that point to .css and .js files causing a 404 error on fetch

= 1.5.9 =
* Updates to documentation

= 1.5.7 =
* Updates to documentation

= 1.5.4 =
* Release management updates
* Updates to documentation

= 1.5.2 =
* Release management updates
* Updates to send host name with activation
* Update comments, extension filters and doc root reporting.

= 1.1.1 =
* Update comments, extension filters and doc root reporting.

= 1.0.0 =
* Initial release.

== Upgrade Notice ==
