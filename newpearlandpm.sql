-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 15, 2012 at 06:45 AM
-- Server version: 5.5.16
-- PHP Version: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `newpearlandpm`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_user`
--

CREATE TABLE IF NOT EXISTS `admin_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(10) NOT NULL DEFAULT '',
  `password` varchar(10) NOT NULL DEFAULT '',
  `last_access` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `allow_pages` varchar(255) NOT NULL DEFAULT '*',
  `type` varchar(20) NOT NULL DEFAULT 'Administrator',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `is_loggedin` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='website control panel scrap table' AUTO_INCREMENT=5 ;

--
-- Dumping data for table `admin_user`
--

INSERT INTO `admin_user` (`id`, `username`, `password`, `last_access`, `allow_pages`, `type`, `is_active`, `is_loggedin`) VALUES
(3, 'test', 'test', '2012-03-14 23:36:13', '*', 'Administrator', 1, 1),
(4, 'admin', 'admin', '2012-02-02 23:35:54', '*', 'Administrator', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE IF NOT EXISTS `contact` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `address1` text,
  `email` varchar(255) NOT NULL DEFAULT '',
  `phone` int(11) NOT NULL DEFAULT '0',
  `address2` text,
  `city` varchar(255) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `postcode` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `web` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `content`
--

CREATE TABLE IF NOT EXISTS `content` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT '',
  `urlname` varchar(255) DEFAULT NULL,
  `page` longtext,
  `page_type` enum('content','module') NOT NULL DEFAULT 'content',
  `module_name` varchar(250) DEFAULT NULL,
  `link_type` enum('internal','external') NOT NULL DEFAULT 'internal',
  `link_query` varchar(255) DEFAULT NULL,
  `meta_keyword` text,
  `meta_description` text,
  `parent_id` int(11) DEFAULT NULL,
  `is_preview` tinyint(1) NOT NULL DEFAULT '0',
  `preview_update_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `publish_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `preview_of_page_id` tinyint(1) NOT NULL DEFAULT '0',
  `page_name` varchar(255) DEFAULT NULL,
  `collection` varchar(255) DEFAULT NULL,
  `navigation` varchar(255) DEFAULT NULL,
  `position` int(11) NOT NULL DEFAULT '0',
  `top_content` text,
  `section` int(255) NOT NULL,
  `show_in_menu` int(11) NOT NULL DEFAULT '1',
  `mobile_site` varchar(255) DEFAULT NULL,
  `mobile_site_content` longtext,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=134 ;

--
-- Dumping data for table `content`
--

INSERT INTO `content` (`id`, `name`, `urlname`, `page`, `page_type`, `module_name`, `link_type`, `link_query`, `meta_keyword`, `meta_description`, `parent_id`, `is_preview`, `preview_update_date`, `publish_date`, `preview_of_page_id`, `page_name`, `collection`, `navigation`, `position`, `top_content`, `section`, `show_in_menu`, `mobile_site`, `mobile_site_content`) VALUES
(129, 'Home page', 'home', '&lt;p&gt;\r\n	&lt;em&gt;Welcome to Pearland Property Management! We provide full-service residential property management &amp;amp; leasing services in Pearland as well as the surrounding cities. The strength of our company is built on honesty, integrity along with a strong line of communication!&lt;/em&gt;&lt;/p&gt;\r\n&lt;p align=&quot;left&quot; style=&quot;text-align: left&quot;&gt;\r\n	Many real estate companies offer property management services as a &amp;quot;side business&amp;quot;. Pearland Property Management &lt;strong&gt;IS&lt;/strong&gt; our business. &amp;nbsp;We do offer brokerage services for some of our clients i.e. sales inquiries, listings, or purchases.&amp;nbsp; We continually strive to improve our services, efficiency, and technology to benefit our clients and tenants.&lt;/p&gt;\r\n&lt;p align=&quot;left&quot; style=&quot;text-align: left&quot;&gt;\r\n	What happens when my property&amp;nbsp;is VACANT?&amp;nbsp; Well, you do not receive rent therefore we do not receive&amp;nbsp;monthly fees.&amp;nbsp; Which then makes finding a new qualify tenant&amp;nbsp;our priority.&lt;/p&gt;\r\n&lt;p align=&quot;left&quot; style=&quot;text-align: left;&quot;&gt;\r\n	&amp;nbsp;&lt;/p&gt;\r\n&lt;p align=&quot;left&quot; style=&quot;text-align: left;&quot;&gt;\r\n	&amp;nbsp;&lt;/p&gt;\r\n&lt;p align=&quot;left&quot; style=&quot;text-align: left;&quot;&gt;\r\n	&amp;nbsp;&lt;/p&gt;\r\n&lt;p align=&quot;left&quot; style=&quot;text-align: left;&quot;&gt;\r\n	&lt;strong&gt;A few of&amp;nbsp;the services&amp;nbsp;we offer:&lt;/strong&gt;&lt;/p&gt;\r\n&lt;ul&gt;\r\n	&lt;li&gt;\r\n		Aggressive Marketing&lt;/li&gt;\r\n	&lt;li&gt;\r\n		Showing Staff 7 Days a Week&lt;/li&gt;\r\n	&lt;li&gt;\r\n		Extensive Tenant Screening:&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&lt;/li&gt;\r\n	&lt;li&gt;\r\n		24 Hour Emergency Service&lt;/li&gt;\r\n	&lt;li&gt;\r\n		Full Disclosure Accounting&lt;/li&gt;\r\n	&lt;li&gt;\r\n		No hidden Fees or Mark - ups&lt;/li&gt;\r\n	&lt;li&gt;\r\n		Frequent Property Inspections&lt;/li&gt;\r\n&lt;/ul&gt;\r\n&lt;p&gt;\r\n	&amp;nbsp;&lt;/p&gt;\r\n&lt;p&gt;\r\n	Click here for additional description of &lt;a href=&quot;http://cweb6/pearlandpm/?page=services&amp;amp;&quot;&gt;services&lt;/a&gt;&lt;/p&gt;\r\n&lt;p&gt;\r\n	Please give us the opportunity to discuss our services in detail with you. So you too can be jumping with joy.&lt;/p&gt;\r\n&lt;p&gt;\r\n	Contact Us today!&amp;nbsp;&amp;nbsp;(832) 499-9406&lt;/p&gt;\r\n', 'content', NULL, 'internal', NULL, 'home page', 'This is the home page of pearlandpm', 0, 0, '2012-03-14 00:00:00', '2012-03-14 00:00:00', 0, 'Home', NULL, NULL, 0, NULL, 0, 1, NULL, NULL),
(130, 'Services', 'services', '&lt;p&gt;\r\n	&lt;strong&gt;Full Service Property Management&lt;/strong&gt;&lt;/p&gt;\r\n&lt;p&gt;\r\n	Our Full Service Property Management is all-inclusive. This service is the solution for owners who want a professional property manager to handle the day-to-day management and responsibilities that a rental property requires. We handle everything associated with the rental of your property. As your property manager we represent you, the owner, throughout the rental process and lease period. Our goal is to provide you with first class service and peace of mind.&lt;/p&gt;\r\n&lt;p&gt;\r\n	&lt;strong&gt;Our property management services include:&lt;/strong&gt;&lt;/p&gt;\r\n&lt;ul&gt;\r\n	&lt;li&gt;\r\n		&lt;strong&gt;Initial Visit &amp;ndash; &lt;/strong&gt;We would meet with you to view the property (or if you are out state, everything can be handle through electronic means), discuss any concerns, and complete a property evaluation and market analysis to help determine the appropriate lease rate for the property. We want to ensure we are maximizing your rental income.&lt;/li&gt;\r\n&lt;/ul&gt;\r\n&lt;p&gt;\r\n	&lt;strong&gt;&amp;nbsp;&lt;/strong&gt;&lt;/p&gt;\r\n&lt;ul&gt;\r\n	&lt;li&gt;\r\n		&lt;strong&gt;Advertising -&lt;/strong&gt; We created an aggressive marketing campaign using the latest technology and online resources to attract prospective tenants. Our ads are individually designed for each property to create a professional look and highlight the special features of your property. We list our properties on Realtor.com, Har.com, Houston Chronicle, Houston.org, Google, Homes.com, just to name a few.&lt;/li&gt;\r\n&lt;/ul&gt;\r\n&lt;p&gt;\r\n	&lt;strong&gt;&amp;nbsp;&lt;/strong&gt;&lt;/p&gt;\r\n&lt;ul&gt;\r\n	&lt;li&gt;\r\n		&lt;strong&gt;Showings - &lt;/strong&gt;You won&amp;rsquo;t find another management company that is more available to show properties. We have to staff to schedule showings on the weekends and evening hours; this is when renters are looking!&lt;/li&gt;\r\n&lt;/ul&gt;\r\n&lt;p&gt;\r\n	&lt;strong&gt;&amp;nbsp;&lt;/strong&gt;&lt;/p&gt;\r\n&lt;ul&gt;\r\n	&lt;li&gt;\r\n		&lt;strong&gt;Tenant Screening -&lt;/strong&gt; A thorough background check is critical in the tenant selection process. Our background check includes credit, criminal, eviction, sex offender, terroist and employment. We also contact previous landlords for referrals.&lt;/li&gt;\r\n&lt;/ul&gt;\r\n&lt;p&gt;\r\n	&lt;strong&gt;&amp;nbsp;&lt;/strong&gt;&lt;/p&gt;\r\n&lt;ul&gt;\r\n	&lt;li&gt;\r\n		&lt;strong&gt;Lease -&lt;/strong&gt; We handle all the necessary paperwork associated with the leasing of your property and ensure compliance with applicable local, state and federal laws. Our lease is promulgated by the Texas Real Estate Commission.&amp;nbsp; We enforce all the terms of the lease including timely rent collection and the tenant&amp;rsquo;s responsibilities to maintain the property.&lt;/li&gt;\r\n&lt;/ul&gt;\r\n&lt;p&gt;\r\n	&lt;strong&gt;&amp;nbsp;&lt;/strong&gt;&lt;/p&gt;\r\n&lt;ul&gt;\r\n	&lt;li&gt;\r\n		&lt;strong&gt;Routine Visits -&lt;/strong&gt; Our property managers personally visit the property 45 days after a tenant moves into the home and then on their annual lease renewal. This visit includes a full walk-thru of the interior and exterior of the property. These visits help us discover tenant damage or neglect, maintenance concerns, unauthorized pets, over occupancy issues, etc, early in the term of the lease.&lt;/li&gt;\r\n&lt;/ul&gt;\r\n&lt;p&gt;\r\n	&lt;strong&gt;&amp;nbsp;&lt;/strong&gt;&lt;/p&gt;\r\n&lt;ul&gt;\r\n	&lt;li&gt;\r\n		&lt;strong&gt;Maintenance -&lt;/strong&gt; We have skilled tradesmen and suppliers available to service your property&amp;rsquo;s needs. With our purchasing power we get high quality service at reasonable rates. Our Vendors are loyal, trustworthy, and quick to respond. All receipts for services are provided upon request.&lt;/li&gt;\r\n&lt;/ul&gt;\r\n&lt;p&gt;\r\n	&lt;strong&gt;&amp;nbsp;&lt;/strong&gt;&lt;/p&gt;\r\n&lt;ul&gt;\r\n	&lt;li&gt;\r\n		&lt;strong&gt;Financials and Reporting - &lt;/strong&gt;Detailed accounting for all income and expenses for your property is provided on a monthly basis. The timely disbursement of funds to owners is a high priority. Copies of all work orders and receipts are kept on file throughout the year, and are available upon request. At the end of the year we supply owners with annual statements categorizing all income and expenses for the property.&lt;/li&gt;\r\n&lt;/ul&gt;\r\n&lt;p&gt;\r\n	&amp;nbsp;&lt;/p&gt;\r\n&lt;p&gt;\r\n	&lt;strong&gt;Fees -&lt;/strong&gt;Our Management Fee&amp;rsquo;s are between 6%-8% of the collected rents. In addition to the Management Fee we charge one month&amp;rsquo;s commission for the time, effort, and cost associated with finding and placing a new tenant (this fee is split with another agent if tenant is represented by an agent). A much smaller Leasing Fee is charged at the time of lease renewal.&lt;/p&gt;\r\n', 'content', NULL, 'internal', NULL, 'services', 'This is services page of pearlandpm', 0, 0, '2012-03-14 00:00:00', '2012-03-14 00:00:00', 0, 'Services', NULL, NULL, 0, NULL, 0, 1, NULL, NULL),
(131, 'About Us', 'about', '&lt;p&gt;\r\n	Pearland Property Management is family owned and locally managed. &amp;nbsp;We are a group of&lt;br /&gt;\r\n	hardworking experienced property managers who understand that your investment&lt;br /&gt;\r\n	requires someone who can address repairs issues when they arise and act an aliaisons between tenants and landlords and renters and contractors.&amp;nbsp;&lt;/p&gt;\r\n&lt;br /&gt;\r\n&lt;p&gt;\r\n	We manage all our properties as if they were our own and providing you with the &amp;quot;peace of mind&amp;quot; that everything we do, we do in your best interest. &amp;nbsp;Again, our main goal is to protect your investment, so you can pass along your investment to your children.&lt;/p&gt;\r\n&lt;br /&gt;\r\n&lt;p&gt;\r\n	We understand you can&amp;#39;t be in two places at once and seek to protect your investment by&lt;br /&gt;\r\n	insuring that every aspect of your property is well maintained and cared for as if it was our&lt;br /&gt;\r\n	own. &amp;nbsp;Pearland Property Management also services townhomes, duplex and condos as&lt;br /&gt;\r\n	well. &amp;nbsp;No property is too big or too small for us.&lt;/p&gt;\r\n&lt;br /&gt;\r\n&lt;p&gt;\r\n	Our name says Pearland but we &lt;u&gt;proudly&lt;/u&gt; serve surrounding cities i.e.&lt;/p&gt;\r\n&lt;p&gt;\r\n	Friendswood, Clear Lake, League City, Pasadena,&amp;nbsp;Houston, Alvin, Manvel, Sugar Land, Stafford, etc.&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&lt;/p&gt;\r\n&lt;br /&gt;\r\n&lt;p&gt;\r\n	&amp;nbsp;Looking forward in working with you,&lt;/p&gt;\r\n&lt;p&gt;\r\n	Cynthia Gomez&lt;br /&gt;\r\n	Owner and Property Manager&lt;br /&gt;\r\n	(713) 933-5380&lt;/p&gt;\r\n&lt;p&gt;\r\n	&lt;img alt=&quot;&quot; src=&quot;http://cweb6/pearlandpm/upload/cms/images/CINDY_292154237_std.JPEG&quot; style=&quot;width: 87px; height: 122px;&quot; /&gt;&lt;/p&gt;\r\n&lt;table style=&quot;width: 678px; height: 219px;&quot;&gt;\r\n	&lt;tbody&gt;\r\n		&lt;tr&gt;\r\n			&lt;td colspan=&quot;2&quot;&gt;\r\n				&lt;h3&gt;\r\n					Memberships &amp;amp; Designations&lt;/h3&gt;\r\n			&lt;/td&gt;\r\n		&lt;/tr&gt;\r\n		&lt;tr&gt;\r\n			&lt;td&gt;\r\n				&lt;ul&gt;\r\n					&lt;li&gt;\r\n						HAR&amp;nbsp; Houston Association of Realtors&lt;/li&gt;\r\n					&lt;li&gt;\r\n						TAR&amp;nbsp; Texas Association of Realtors&lt;/li&gt;\r\n					&lt;li&gt;\r\n						NAR&amp;nbsp; National Association of Realtors&lt;/li&gt;\r\n					&lt;li&gt;\r\n						MLS&amp;nbsp;&amp;nbsp; Multiple Listing Service&lt;/li&gt;\r\n					&lt;li&gt;\r\n						SFR&amp;nbsp;&amp;nbsp;&amp;nbsp; Short Sales&amp;nbsp;&amp;amp; Foreclosures Resource&amp;nbsp;&lt;/li&gt;\r\n				&lt;/ul&gt;\r\n				&lt;p&gt;\r\n					&amp;nbsp;&lt;/p&gt;\r\n			&lt;/td&gt;\r\n			&lt;td&gt;\r\n				&lt;img alt=&quot;&quot; src=&quot;http://cweb6/pearlandpm/upload/cms/images/happy_family_29444203_std.jpg&quot; style=&quot;width: 307px; height: 163px;&quot; /&gt;&lt;/td&gt;\r\n		&lt;/tr&gt;\r\n	&lt;/tbody&gt;\r\n&lt;/table&gt;\r\n&lt;p&gt;\r\n	&amp;nbsp;&lt;/p&gt;\r\n', 'content', NULL, 'internal', NULL, 'about us', 'This is about of the pearlandpm', 0, 0, '2012-03-15 00:00:00', '2012-03-15 00:00:00', 0, 'About us', NULL, NULL, 0, NULL, 0, 1, NULL, NULL),
(132, 'Testimonials', 'testimonials', '&lt;p&gt;\r\n	This page will be comming soon.&lt;/p&gt;\r\n', 'content', NULL, 'internal', NULL, '', '', 0, 0, '2012-03-14 00:00:00', '2012-03-14 00:00:00', 0, 'Testimonials', NULL, NULL, 0, NULL, 0, 1, NULL, NULL),
(133, 'contact us', 'contact', '&lt;p&gt;\r\n	You will find that working with Pearland Property Management is a very pleasant experience. Our professional, courteous staff will always treat you and your clients with the utmost respect. Please contact us now and we can begin on our new relationship today!&amp;nbsp;&lt;/p&gt;\r\n&lt;p&gt;\r\n	If you have any questions or concerns please share with me.&lt;/p&gt;\r\n&lt;p&gt;\r\n	We would love to hear from you!&amp;nbsp; There are three ways to contact us: you can email us, enter your contact information&amp;nbsp;on this page or call us at the number listed below.&lt;/p&gt;\r\n&lt;p&gt;\r\n	&lt;img alt=&quot;&quot; src=&quot;http://cweb6/pearlandpm/upload/cms/images/contactus.png&quot; style=&quot;width: 92px; height: 61px;&quot; /&gt;&lt;br /&gt;\r\n	Rent Payment Address (all properties):&lt;br /&gt;\r\n	PO Box 3232 Pearland TX 77588&lt;/p&gt;\r\n&lt;p&gt;\r\n	&lt;strong&gt;by Appointment: &lt;/strong&gt;&lt;/p&gt;\r\n&lt;p&gt;\r\n	2734 Sunrise Blvd Ste 208&lt;br /&gt;\r\n	Pearland, TX 77584&lt;br /&gt;\r\n	ph: 832-499-9406&lt;br /&gt;\r\n	fax: 281.598.5711&lt;/p&gt;\r\n&lt;p&gt;\r\n	&lt;a data-mce-=&quot;&quot; href=&quot;mailto:cindy@pearlandpm.com&quot;&gt;cindy@pearlandpm.com&lt;/a&gt;&lt;/p&gt;\r\n&lt;p&gt;\r\n	&amp;nbsp;&lt;/p&gt;\r\n&lt;p&gt;\r\n	&lt;u&gt;&lt;strong&gt;Hours of Operation&lt;/strong&gt;&lt;/u&gt;&lt;/p&gt;\r\n&lt;p&gt;\r\n	Office Hours:&amp;nbsp; Monday-Friday 9AM-5:30PM&lt;br /&gt;\r\n	24 Hour&amp;nbsp;Emergency Response 832-499-9406&lt;/p&gt;\r\n&lt;div id=&quot;mapZone&quot;&gt;\r\n	&lt;div id=&quot;mapDrivingDirections&quot;&gt;\r\n		&amp;nbsp;&lt;/div&gt;\r\n&lt;/div&gt;\r\n&lt;p&gt;\r\n	&amp;nbsp;&lt;/p&gt;\r\n', 'content', NULL, 'internal', NULL, 'contact us', 'contact us page', 0, 0, '2012-03-14 00:00:00', '2012-03-14 00:00:00', 0, 'Contact Us', NULL, NULL, 0, NULL, 0, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `email`
--

CREATE TABLE IF NOT EXISTS `email` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email_name` varchar(255) DEFAULT NULL,
  `email_subject` varchar(255) DEFAULT NULL,
  `email_text` text,
  `email_type` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `email`
--

INSERT INTO `email` (`id`, `email_name`, `email_subject`, `email_text`, `email_type`) VALUES
(1, 'Forgot Password', 'Reset your password', '&lt;p&gt;\r\n	***This is an automated email, please do not reply***&lt;/p&gt;\r\n&lt;p&gt;\r\n	Hi {FIRST_NAME} {LAST_NAME},&lt;/p&gt;\r\n&lt;p&gt;\r\n	Please click the link below to activate your website account. If the link is not clickable then copy and paste the link into the address bar in your browser.&lt;/p&gt;\r\n&lt;p&gt;\r\n	&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;gt;&amp;gt;&amp;gt;&amp;gt;&amp;gt;&amp;gt;&amp;gt;&amp;gt;&amp;gt;&amp;gt;&amp;gt;&amp;gt;&amp;gt;&amp;gt;&amp;gt;&amp;gt;&amp;gt;&amp;gt;&amp;gt;&amp;gt;&amp;gt;&amp;gt;&amp;gt;&amp;gt;&amp;gt;&lt;/p&gt;\r\n&lt;p&gt;\r\n	{VERIFY_URL}&lt;/p&gt;\r\n&lt;p&gt;\r\n	&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;gt;&amp;gt;&amp;gt;&amp;gt;&amp;gt;&amp;gt;&amp;gt;&amp;gt;&amp;gt;&amp;gt;&amp;gt;&amp;gt;&amp;gt;&amp;gt;&amp;gt;&amp;gt;&amp;gt;&amp;gt;&amp;gt;&amp;gt;&amp;gt;&amp;gt;&amp;gt;&amp;gt;&amp;gt;&lt;/p&gt;\r\n&lt;p&gt;\r\n	If you did not setup this account please email us at&amp;nbsp;{SALES_EMAIL}&lt;/p&gt;\r\n&lt;p&gt;\r\n	Best Regards,&lt;/p&gt;\r\n&lt;p&gt;\r\n	{SITE_NAME}&lt;/p&gt;\r\n', 'HTML'),
(2, 'Message', 'Message From Admin', '&lt;p&gt;Name :{FIRST_NAME}&lt;/p&gt;\r\n&lt;p&gt;Email Address :{YOUR_EMAIL}&lt;/p&gt;\r\n&lt;p&gt;Message : {MESSAGE}.&lt;/p&gt;\r\n&lt;p&gt;Best Regards,&lt;/p&gt;\r\n&lt;p&gt;{SITE_NAME}&lt;/p&gt;', 'HTML'),
(3, 'Dispatch Note', 'Dispatch Note', '&lt;p&gt;&lt;span style=&quot;font-family: ''Times New Roman'',''serif''; font-size: 12pt; mso-fareast-font-family: ''Times New Roman''&quot;&gt;This e-mail is confidential and contains privileged information. If you are not the named recipient, please e-mail or phone us immediately. You should not disclose the contents to any person, take copies, or use it for any purpose. &lt;o:p&gt;&lt;/o:p&gt;&lt;/span&gt;&lt;/p&gt;\r\n&lt;p style=&quot;line-height: normal; margin: 0in 0in 12pt&quot; class=&quot;MsoNormal&quot;&gt;&lt;span style=&quot;font-family: ''Times New Roman'',''serif''; font-size: 12pt; mso-fareast-font-family: ''Times New Roman''&quot;&gt;Dear &lt;/span&gt;&lt;span style=&quot;font-family: ''Arial'',''sans-serif''; font-size: 9pt; mso-fareast-font-family: ''Times New Roman''&quot;&gt;{FIRST_NAME}{LAST_NAME}, &lt;/span&gt;&lt;span style=&quot;font-family: ''Times New Roman'',''serif''; font-size: 12pt; mso-fareast-font-family: ''Times New Roman''&quot;&gt;&lt;span style=&quot;mso-spacerun: yes&quot;&gt;&amp;nbsp;&lt;/span&gt;Thank You for shopping with cWebCart. &lt;o:p&gt;&lt;/o:p&gt;&lt;/span&gt;&lt;/p&gt;\r\n&lt;p style=&quot;line-height: normal; margin: 0in 0in 12pt&quot; class=&quot;MsoNormal&quot;&gt;&lt;b&gt;&lt;span style=&quot;font-family: ''Times New Roman'',''serif''; font-size: 12pt; mso-fareast-font-family: ''Times New Roman''&quot;&gt;Order Number: &lt;/span&gt;&lt;/b&gt;&lt;span style=&quot;font-family: ''Arial'',''sans-serif''; font-size: 9pt; mso-fareast-font-family: ''Times New Roman''&quot;&gt;{ORDER_NUMBER}&lt;/span&gt;&lt;span style=&quot;font-family: ''Times New Roman'',''serif''; font-size: 12pt; mso-fareast-font-family: ''Times New Roman''&quot;&gt;&lt;br /&gt;\r\n&lt;b&gt;VAT Number: &lt;/b&gt;&lt;/span&gt;&lt;span style=&quot;font-family: ''Arial'',''sans-serif''; font-size: 9pt; mso-fareast-font-family: ''Times New Roman''&quot;&gt;{VAT_NUMBER}&lt;/span&gt;&lt;span style=&quot;font-family: ''Times New Roman'',''serif''; font-size: 12pt; mso-fareast-font-family: ''Times New Roman''&quot;&gt;&lt;br /&gt;\r\n&lt;b&gt;Order date: &lt;/b&gt;&lt;/span&gt;&lt;span style=&quot;font-family: ''Arial'',''sans-serif''; font-size: 9pt; mso-fareast-font-family: ''Times New Roman''&quot;&gt;{ORDER_DATE}&lt;/span&gt;&lt;span style=&quot;font-family: ''Times New Roman'',''serif''; font-size: 12pt; mso-fareast-font-family: ''Times New Roman''&quot;&gt;&lt;o:p&gt;&lt;/o:p&gt;&lt;/span&gt;&lt;/p&gt;\r\n&lt;p style=&quot;line-height: normal; margin: 0in 0in 0pt&quot; class=&quot;MsoNormal&quot;&gt;&lt;span style=&quot;font-family: ''Times New Roman'',''serif''; font-size: 12pt; mso-fareast-font-family: ''Times New Roman''&quot;&gt;Customer Details&lt;o:p&gt;&lt;/o:p&gt;&lt;/span&gt;&lt;/p&gt;\r\n&lt;p&gt;\r\n&lt;table style=&quot;width: 100%; mso-cellspacing: .7pt; mso-yfti-tbllook: 1184; mso-padding-alt: 0in 0in 0in 0in&quot; class=&quot;MsoNormalTable&quot; border=&quot;0&quot; cellspacing=&quot;1&quot; cellpadding=&quot;0&quot; width=&quot;100%&quot;&gt;\r\n    &lt;tbody&gt;\r\n        &lt;tr style=&quot;mso-yfti-irow: 0; mso-yfti-firstrow: yes&quot;&gt;\r\n            &lt;td style=&quot;border-bottom: #ece9d8; border-left: #ece9d8; padding-bottom: 0in; background-color: transparent; padding-left: 0in; width: 50%; padding-right: 0in; border-top: #ece9d8; border-right: #ece9d8; padding-top: 0in&quot; valign=&quot;top&quot; width=&quot;50%&quot;&gt;\r\n            &lt;p style=&quot;line-height: normal; margin: 0in 0in 0pt&quot; class=&quot;MsoNormal&quot;&gt;&lt;span style=&quot;font-family: ''Times New Roman'',''serif''; font-size: 12pt; mso-fareast-font-family: ''Times New Roman''&quot;&gt;Billing Address&lt;o:p&gt;&lt;/o:p&gt;&lt;/span&gt;&lt;/p&gt;\r\n            &lt;/td&gt;\r\n            &lt;td style=&quot;border-bottom: #ece9d8; border-left: #ece9d8; padding-bottom: 0in; background-color: transparent; padding-left: 0in; padding-right: 0in; border-top: #ece9d8; border-right: #ece9d8; padding-top: 0in&quot; valign=&quot;top&quot;&gt;\r\n            &lt;p style=&quot;line-height: normal; margin: 0in 0in 0pt&quot; class=&quot;MsoNormal&quot;&gt;&lt;span style=&quot;font-family: ''Arial'',''sans-serif''; font-size: 9pt; mso-fareast-font-family: ''Times New Roman''&quot;&gt;{BILLING_FIRST_NAME} {BILLING_LAST_NAME}&lt;/span&gt;&lt;/p&gt;\r\n            &lt;p style=&quot;line-height: normal; margin: 0in 0in 0pt&quot; class=&quot;MsoNormal&quot;&gt;&lt;span style=&quot;font-family: ''Arial'',''sans-serif''; font-size: 9pt; mso-fareast-font-family: ''Times New Roman''&quot;&gt;&amp;nbsp;{BILLING_ADDRESS1}&lt;o:p&gt;&lt;/o:p&gt;&lt;/span&gt;&lt;/p&gt;\r\n            &lt;p style=&quot;line-height: normal; margin: 0in 0in 0pt&quot; class=&quot;MsoNormal&quot;&gt;&lt;span style=&quot;font-family: ''Arial'',''sans-serif''; font-size: 9pt; mso-fareast-font-family: ''Times New Roman''&quot;&gt;{BILLING_ADDRESS2}&lt;o:p&gt;&lt;/o:p&gt;&lt;/span&gt;&lt;/p&gt;\r\n            &lt;p style=&quot;line-height: normal; margin: 0in 0in 0pt&quot; class=&quot;MsoNormal&quot;&gt;&lt;span style=&quot;font-family: ''Arial'',''sans-serif''; font-size: 9pt; mso-fareast-font-family: ''Times New Roman''&quot;&gt;{BILLING_CITY} &lt;o:p&gt;&lt;/o:p&gt;&lt;/span&gt;&lt;/p&gt;\r\n            &lt;p style=&quot;line-height: normal; margin: 0in 0in 0pt&quot; class=&quot;MsoNormal&quot;&gt;&lt;span style=&quot;font-family: ''Arial'',''sans-serif''; font-size: 9pt; mso-fareast-font-family: ''Times New Roman''&quot;&gt;{BILLING_STATE}&lt;o:p&gt;&lt;/o:p&gt;&lt;/span&gt;&lt;/p&gt;\r\n            &lt;p style=&quot;line-height: normal; margin: 0in 0in 0pt&quot; class=&quot;MsoNormal&quot;&gt;&lt;span style=&quot;font-family: ''Arial'',''sans-serif''; font-size: 9pt; mso-fareast-font-family: ''Times New Roman''&quot;&gt;{BILLING_COUNTRY} &lt;o:p&gt;&lt;/o:p&gt;&lt;/span&gt;&lt;/p&gt;\r\n            &lt;p style=&quot;line-height: normal; margin: 0in 0in 0pt&quot; class=&quot;MsoNormal&quot;&gt;&lt;span style=&quot;font-family: ''Arial'',''sans-serif''; font-size: 9pt; mso-fareast-font-family: ''Times New Roman''&quot;&gt;{BILLING_POSTCODE}&lt;/span&gt;&lt;span style=&quot;font-family: ''Times New Roman'',''serif''; font-size: 12pt; mso-fareast-font-family: ''Times New Roman''&quot;&gt;&lt;br style=&quot;mso-special-character: line-break&quot; /&gt;\r\n            &lt;br style=&quot;mso-special-character: line-break&quot; /&gt;\r\n            &lt;o:p&gt;&lt;/o:p&gt;&lt;/span&gt;&lt;/p&gt;\r\n            &lt;/td&gt;\r\n        &lt;/tr&gt;\r\n        &lt;tr style=&quot;mso-yfti-irow: 1&quot;&gt;\r\n            &lt;td style=&quot;border-bottom: #ece9d8; border-left: #ece9d8; padding-bottom: 0in; background-color: transparent; padding-left: 0in; width: 50%; padding-right: 0in; border-top: #ece9d8; border-right: #ece9d8; padding-top: 0in&quot; valign=&quot;top&quot; width=&quot;50%&quot;&gt;\r\n            &lt;p style=&quot;line-height: normal; margin: 0in 0in 0pt&quot; class=&quot;MsoNormal&quot;&gt;&lt;span style=&quot;font-family: ''Times New Roman'',''serif''; font-size: 12pt; mso-fareast-font-family: ''Times New Roman''&quot;&gt;Customer Telephone Number&lt;o:p&gt;&lt;/o:p&gt;&lt;/span&gt;&lt;/p&gt;\r\n            &lt;/td&gt;\r\n            &lt;td style=&quot;border-bottom: #ece9d8; border-left: #ece9d8; padding-bottom: 0in; background-color: transparent; padding-left: 0in; padding-right: 0in; border-top: #ece9d8; border-right: #ece9d8; padding-top: 0in&quot; valign=&quot;top&quot;&gt;\r\n            &lt;p style=&quot;line-height: normal; margin: 0in 0in 0pt&quot; class=&quot;MsoNormal&quot;&gt;&lt;span style=&quot;font-family: ''Arial'',''sans-serif''; font-size: 9pt; mso-fareast-font-family: ''Times New Roman''&quot;&gt;{BILLING_PHONE}&lt;/span&gt;&lt;span style=&quot;font-family: ''Times New Roman'',''serif''; font-size: 12pt; mso-fareast-font-family: ''Times New Roman''&quot;&gt;&lt;o:p&gt;&lt;/o:p&gt;&lt;/span&gt;&lt;/p&gt;\r\n            &lt;/td&gt;\r\n        &lt;/tr&gt;\r\n        &lt;tr style=&quot;mso-yfti-irow: 2; mso-yfti-lastrow: yes&quot;&gt;\r\n            &lt;td style=&quot;border-bottom: #ece9d8; border-left: #ece9d8; padding-bottom: 0in; background-color: transparent; padding-left: 0in; width: 50%; padding-right: 0in; border-top: #ece9d8; border-right: #ece9d8; padding-top: 0in&quot; valign=&quot;top&quot; width=&quot;50%&quot;&gt;\r\n            &lt;p style=&quot;line-height: normal; margin: 0in 0in 0pt&quot; class=&quot;MsoNormal&quot;&gt;&lt;span style=&quot;font-family: ''Times New Roman'',''serif''; font-size: 12pt; mso-fareast-font-family: ''Times New Roman''&quot;&gt;E-mail Address&lt;o:p&gt;&lt;/o:p&gt;&lt;/span&gt;&lt;/p&gt;\r\n            &lt;/td&gt;\r\n            &lt;td style=&quot;border-bottom: #ece9d8; border-left: #ece9d8; padding-bottom: 0in; background-color: transparent; padding-left: 0in; padding-right: 0in; border-top: #ece9d8; border-right: #ece9d8; padding-top: 0in&quot; valign=&quot;top&quot;&gt;\r\n            &lt;p style=&quot;line-height: normal; margin: 0in 0in 0pt&quot; class=&quot;MsoNormal&quot;&gt;&lt;span style=&quot;font-family: ''Arial'',''sans-serif''; font-size: 9pt; mso-fareast-font-family: ''Times New Roman''&quot;&gt;{BILLING_EMAIL}&lt;/span&gt;&lt;span style=&quot;font-family: ''Times New Roman'',''serif''; font-size: 12pt; mso-fareast-font-family: ''Times New Roman''&quot;&gt;&lt;o:p&gt;&lt;/o:p&gt;&lt;/span&gt;&lt;/p&gt;\r\n            &lt;/td&gt;\r\n        &lt;/tr&gt;\r\n    &lt;/tbody&gt;\r\n&lt;/table&gt;\r\n&lt;/p&gt;\r\n&lt;p style=&quot;line-height: normal; margin: 0in 0in 0pt&quot; class=&quot;MsoNormal&quot;&gt;&lt;span style=&quot;font-family: ''Times New Roman'',''serif''; font-size: 12pt; mso-fareast-font-family: ''Times New Roman''&quot;&gt;Delivery Details&lt;o:p&gt;&lt;/o:p&gt;&lt;/span&gt;&lt;/p&gt;\r\n&lt;p&gt;\r\n&lt;table style=&quot;width: 100%; mso-cellspacing: .7pt; mso-yfti-tbllook: 1184; mso-padding-alt: 0in 0in 0in 0in&quot; class=&quot;MsoNormalTable&quot; border=&quot;0&quot; cellspacing=&quot;1&quot; cellpadding=&quot;0&quot; width=&quot;100%&quot;&gt;\r\n    &lt;tbody&gt;\r\n        &lt;tr style=&quot;mso-yfti-irow: 0; mso-yfti-firstrow: yes&quot;&gt;\r\n            &lt;td style=&quot;border-bottom: #ece9d8; border-left: #ece9d8; padding-bottom: 0in; background-color: transparent; padding-left: 0in; width: 48.82%; padding-right: 0in; border-top: #ece9d8; border-right: #ece9d8; padding-top: 0in&quot; valign=&quot;top&quot; width=&quot;48%&quot;&gt;\r\n            &lt;p style=&quot;line-height: normal; margin: 0in 0in 0pt&quot; class=&quot;MsoNormal&quot;&gt;&lt;span style=&quot;font-family: ''Times New Roman'',''serif''; font-size: 12pt; mso-fareast-font-family: ''Times New Roman''&quot;&gt;Delivery Address&lt;o:p&gt;&lt;/o:p&gt;&lt;/span&gt;&lt;/p&gt;\r\n            &lt;/td&gt;\r\n            &lt;td style=&quot;border-bottom: #ece9d8; border-left: #ece9d8; padding-bottom: 0in; background-color: transparent; padding-left: 0in; width: 50.74%; padding-right: 0in; border-top: #ece9d8; border-right: #ece9d8; padding-top: 0in&quot; valign=&quot;top&quot; width=&quot;50%&quot;&gt;\r\n            &lt;p style=&quot;line-height: normal; margin: 0in 0in 0pt&quot; class=&quot;MsoNormal&quot;&gt;&lt;span style=&quot;font-family: ''Arial'',''sans-serif''; font-size: 9pt; mso-fareast-font-family: ''Times New Roman''&quot;&gt;{SHIPPING_FIRST_NAME} {SHIPPING_LAST_NAME}&lt;/span&gt;&lt;span style=&quot;font-family: ''Times New Roman'',''serif''; font-size: 12pt; mso-fareast-font-family: ''Times New Roman''&quot;&gt;&lt;br /&gt;\r\n            &lt;/span&gt;&lt;span style=&quot;font-family: ''Arial'',''sans-serif''; font-size: 9pt; mso-fareast-font-family: ''Times New Roman''&quot;&gt;{SHIPPING_ADDRESS1}&lt;/span&gt;&lt;span style=&quot;font-family: ''Times New Roman'',''serif''; font-size: 12pt; mso-fareast-font-family: ''Times New Roman''&quot;&gt;&lt;br /&gt;\r\n            &lt;/span&gt;&lt;span style=&quot;font-family: ''Arial'',''sans-serif''; font-size: 9pt; mso-fareast-font-family: ''Times New Roman''&quot;&gt;{SHIPPING_ADDRESS2}&lt;/span&gt;&lt;span style=&quot;font-family: ''Times New Roman'',''serif''; font-size: 12pt; mso-fareast-font-family: ''Times New Roman''&quot;&gt;&lt;br /&gt;\r\n            &lt;/span&gt;&lt;span style=&quot;font-family: ''Arial'',''sans-serif''; font-size: 9pt; mso-fareast-font-family: ''Times New Roman''&quot;&gt;{SHIPPING_CITY}&lt;/span&gt;&lt;span style=&quot;font-family: ''Times New Roman'',''serif''; font-size: 12pt; mso-fareast-font-family: ''Times New Roman''&quot;&gt;&lt;br /&gt;\r\n            &lt;/span&gt;&lt;span style=&quot;font-family: ''Arial'',''sans-serif''; font-size: 9pt; mso-fareast-font-family: ''Times New Roman''&quot;&gt;{SHIPPING_STATE}&lt;/span&gt;&lt;span style=&quot;font-family: ''Times New Roman'',''serif''; font-size: 12pt; mso-fareast-font-family: ''Times New Roman''&quot;&gt;&lt;br /&gt;\r\n            &lt;/span&gt;&lt;span style=&quot;font-family: ''Arial'',''sans-serif''; font-size: 9pt; mso-fareast-font-family: ''Times New Roman''&quot;&gt;{SHIPPING_COUNTRY}&lt;/span&gt;&lt;span style=&quot;font-family: ''Times New Roman'',''serif''; font-size: 12pt; mso-fareast-font-family: ''Times New Roman''&quot;&gt;&lt;br /&gt;\r\n            &lt;/span&gt;&lt;span style=&quot;font-family: ''Arial'',''sans-serif''; font-size: 9pt; mso-fareast-font-family: ''Times New Roman''&quot;&gt;{SHIPPING_POSTCODE}&lt;/span&gt;&lt;span style=&quot;font-family: ''Times New Roman'',''serif''; font-size: 12pt; mso-fareast-font-family: ''Times New Roman''&quot;&gt;&lt;o:p&gt;&lt;/o:p&gt;&lt;/span&gt;&lt;/p&gt;\r\n            &lt;/td&gt;\r\n        &lt;/tr&gt;\r\n        &lt;tr style=&quot;mso-yfti-irow: 1; mso-yfti-lastrow: yes&quot;&gt;\r\n            &lt;td style=&quot;border-bottom: #ece9d8; border-left: #ece9d8; padding-bottom: 0in; background-color: transparent; padding-left: 0in; width: 48.82%; padding-right: 0in; border-top: #ece9d8; border-right: #ece9d8; padding-top: 0in&quot; valign=&quot;top&quot; width=&quot;48%&quot;&gt;\r\n            &lt;p style=&quot;line-height: normal; margin: 0in 0in 0pt&quot; class=&quot;MsoNormal&quot;&gt;&lt;span style=&quot;font-family: ''Times New Roman'',''serif''; font-size: 12pt; mso-fareast-font-family: ''Times New Roman''&quot;&gt;Delivery Telephone Number&lt;o:p&gt;&lt;/o:p&gt;&lt;/span&gt;&lt;/p&gt;\r\n            &lt;/td&gt;\r\n            &lt;td style=&quot;border-bottom: #ece9d8; border-left: #ece9d8; padding-bottom: 0in; background-color: transparent; padding-left: 0in; width: 50.74%; padding-right: 0in; border-top: #ece9d8; border-right: #ece9d8; padding-top: 0in&quot; valign=&quot;top&quot; width=&quot;50%&quot;&gt;\r\n            &lt;p style=&quot;line-height: normal; margin: 0in 0in 0pt&quot; class=&quot;MsoNormal&quot;&gt;&lt;span style=&quot;font-family: ''Arial'',''sans-serif''; font-size: 9pt; mso-fareast-font-family: ''Times New Roman''&quot;&gt;{SHIPPING_PHONE}&lt;/span&gt;&lt;span style=&quot;font-family: ''Times New Roman'',''serif''; font-size: 12pt; mso-fareast-font-family: ''Times New Roman''&quot;&gt;&lt;o:p&gt;&lt;/o:p&gt;&lt;/span&gt;&lt;/p&gt;\r\n            &lt;/td&gt;\r\n        &lt;/tr&gt;\r\n    &lt;/tbody&gt;\r\n&lt;/table&gt;\r\n&lt;/p&gt;\r\n&lt;p style=&quot;line-height: normal; margin: 0in 0in 0pt&quot; class=&quot;MsoNormal&quot;&gt;&lt;span style=&quot;font-family: ''Times New Roman'',''serif''; font-size: 12pt; mso-fareast-font-family: ''Times New Roman''&quot;&gt;Order Details&lt;o:p&gt;&lt;/o:p&gt;&lt;/span&gt;&lt;/p&gt;\r\n&lt;p style=&quot;line-height: normal; margin: 0in 0in 0pt&quot; class=&quot;MsoNormal&quot;&gt;&lt;span style=&quot;font-family: ''Times New Roman'',''serif''; font-size: 12pt; mso-fareast-font-family: ''Times New Roman''&quot;&gt;Product Detail&lt;o:p&gt;&lt;/o:p&gt;&lt;/span&gt;&lt;/p&gt;\r\n&lt;p&gt;\r\n&lt;table style=&quot;width: 100%; mso-cellspacing: .7pt; mso-yfti-tbllook: 1184; mso-padding-alt: 0in 0in 0in 0in&quot; class=&quot;MsoNormalTable&quot; border=&quot;0&quot; cellspacing=&quot;1&quot; cellpadding=&quot;0&quot; width=&quot;100%&quot;&gt;\r\n    &lt;tbody&gt;\r\n        &lt;tr style=&quot;mso-yfti-irow: 0; mso-yfti-firstrow: yes&quot;&gt;\r\n            &lt;td style=&quot;border-bottom: #ece9d8; border-left: #ece9d8; padding-bottom: 0in; background-color: transparent; padding-left: 0in; width: 50%; padding-right: 0in; border-top: #ece9d8; border-right: #ece9d8; padding-top: 0in&quot; valign=&quot;top&quot; width=&quot;50%&quot;&gt;\r\n            &lt;p style=&quot;line-height: normal; margin: 0in 0in 0pt&quot; class=&quot;MsoNormal&quot;&gt;&lt;span style=&quot;font-family: ''Times New Roman'',''serif''; font-size: 12pt; mso-fareast-font-family: ''Times New Roman''&quot;&gt;Product Name&lt;o:p&gt;&lt;/o:p&gt;&lt;/span&gt;&lt;/p&gt;\r\n            &lt;/td&gt;\r\n            &lt;td style=&quot;border-bottom: #ece9d8; border-left: #ece9d8; padding-bottom: 0in; background-color: transparent; padding-left: 0in; padding-right: 0in; border-top: #ece9d8; border-right: #ece9d8; padding-top: 0in&quot; valign=&quot;top&quot;&gt;\r\n            &lt;p style=&quot;line-height: normal; margin: 0in 0in 0pt&quot; class=&quot;MsoNormal&quot;&gt;&lt;span style=&quot;font-family: ''Arial'',''sans-serif''; font-size: 9pt; mso-fareast-font-family: ''Times New Roman''&quot;&gt;{PRODUCT_NAME}&lt;/span&gt;&lt;span style=&quot;font-family: ''Times New Roman'',''serif''; font-size: 12pt; mso-fareast-font-family: ''Times New Roman''&quot;&gt;&lt;o:p&gt;&lt;/o:p&gt;&lt;/span&gt;&lt;/p&gt;\r\n            &lt;/td&gt;\r\n        &lt;/tr&gt;\r\n        &lt;tr style=&quot;mso-yfti-irow: 1; mso-yfti-lastrow: yes&quot;&gt;\r\n            &lt;td style=&quot;border-bottom: #ece9d8; border-left: #ece9d8; padding-bottom: 0in; background-color: transparent; padding-left: 0in; width: 50%; padding-right: 0in; border-top: #ece9d8; border-right: #ece9d8; padding-top: 0in&quot; valign=&quot;top&quot; width=&quot;50%&quot;&gt;\r\n            &lt;p style=&quot;line-height: normal; margin: 0in 0in 0pt&quot; class=&quot;MsoNormal&quot;&gt;&lt;span style=&quot;font-family: ''Times New Roman'',''serif''; font-size: 12pt; mso-fareast-font-family: ''Times New Roman''&quot;&gt;Quantity&lt;o:p&gt;&lt;/o:p&gt;&lt;/span&gt;&lt;/p&gt;\r\n            &lt;/td&gt;\r\n            &lt;td style=&quot;border-bottom: #ece9d8; border-left: #ece9d8; padding-bottom: 0in; background-color: transparent; padding-left: 0in; padding-right: 0in; border-top: #ece9d8; border-right: #ece9d8; padding-top: 0in&quot; valign=&quot;top&quot;&gt;\r\n            &lt;p style=&quot;line-height: normal; margin: 0in 0in 0pt&quot; class=&quot;MsoNormal&quot;&gt;&lt;span style=&quot;font-family: ''Arial'',''sans-serif''; font-size: 9pt; mso-fareast-font-family: ''Times New Roman''&quot;&gt;{QUANTITY}&lt;/span&gt;&lt;span style=&quot;font-family: ''Times New Roman'',''serif''; font-size: 12pt; mso-fareast-font-family: ''Times New Roman''&quot;&gt;&lt;o:p&gt;&lt;/o:p&gt;&lt;/span&gt;&lt;/p&gt;\r\n            &lt;/td&gt;\r\n        &lt;/tr&gt;\r\n    &lt;/tbody&gt;\r\n&lt;/table&gt;\r\n&lt;/p&gt;\r\n&lt;p style=&quot;line-height: normal; margin: 0in 0in 0pt&quot; class=&quot;MsoNormal&quot;&gt;&lt;span style=&quot;display: none; font-family: ''Times New Roman'',''serif''; font-size: 12pt; mso-fareast-font-family: ''Times New Roman''; mso-hide: all&quot;&gt;&lt;o:p&gt;&amp;nbsp;&lt;/o:p&gt;&lt;/span&gt;&lt;/p&gt;\r\n&lt;p&gt;\r\n&lt;table style=&quot;width: 100%; mso-cellspacing: .7pt; mso-yfti-tbllook: 1184; mso-padding-alt: 0in 0in 0in 0in&quot; class=&quot;MsoNormalTable&quot; border=&quot;0&quot; cellspacing=&quot;1&quot; cellpadding=&quot;0&quot; width=&quot;100%&quot;&gt;\r\n    &lt;tbody&gt;\r\n        &lt;tr style=&quot;mso-yfti-irow: 0; mso-yfti-firstrow: yes&quot;&gt;\r\n            &lt;td style=&quot;border-bottom: #ece9d8; border-left: #ece9d8; padding-bottom: 0in; background-color: transparent; padding-left: 0in; width: 50%; padding-right: 0in; border-top: #ece9d8; border-right: #ece9d8; padding-top: 0in&quot; valign=&quot;top&quot; width=&quot;50%&quot;&gt;\r\n            &lt;p style=&quot;line-height: normal; margin: 0in 0in 0pt&quot; class=&quot;MsoNormal&quot;&gt;&lt;span style=&quot;font-family: ''Times New Roman'',''serif''; font-size: 12pt; mso-fareast-font-family: ''Times New Roman''&quot;&gt;Sub Total&lt;o:p&gt;&lt;/o:p&gt;&lt;/span&gt;&lt;/p&gt;\r\n            &lt;/td&gt;\r\n            &lt;td style=&quot;border-bottom: #ece9d8; border-left: #ece9d8; padding-bottom: 0in; background-color: transparent; padding-left: 0in; padding-right: 0in; border-top: #ece9d8; border-right: #ece9d8; padding-top: 0in&quot; valign=&quot;top&quot;&gt;\r\n            &lt;p style=&quot;line-height: normal; margin: 0in 0in 0pt&quot; class=&quot;MsoNormal&quot;&gt;&lt;span style=&quot;font-family: ''Arial'',''sans-serif''; font-size: 9pt; mso-fareast-font-family: ''Times New Roman''&quot;&gt;{SUB_TOTAL}&lt;/span&gt;&lt;span style=&quot;font-family: ''Times New Roman'',''serif''; font-size: 12pt; mso-fareast-font-family: ''Times New Roman''&quot;&gt;&lt;o:p&gt;&lt;/o:p&gt;&lt;/span&gt;&lt;/p&gt;\r\n            &lt;/td&gt;\r\n        &lt;/tr&gt;\r\n        &lt;tr style=&quot;mso-yfti-irow: 1&quot;&gt;\r\n            &lt;td style=&quot;border-bottom: #ece9d8; border-left: #ece9d8; padding-bottom: 0in; background-color: transparent; padding-left: 0in; width: 50%; padding-right: 0in; border-top: #ece9d8; border-right: #ece9d8; padding-top: 0in&quot; valign=&quot;top&quot; width=&quot;50%&quot;&gt;\r\n            &lt;p style=&quot;line-height: normal; margin: 0in 0in 0pt&quot; class=&quot;MsoNormal&quot;&gt;&lt;span style=&quot;font-family: ''Times New Roman'',''serif''; font-size: 12pt; mso-fareast-font-family: ''Times New Roman''&quot;&gt;Delivery Charges&lt;o:p&gt;&lt;/o:p&gt;&lt;/span&gt;&lt;/p&gt;\r\n            &lt;/td&gt;\r\n            &lt;td style=&quot;border-bottom: #ece9d8; border-left: #ece9d8; padding-bottom: 0in; background-color: transparent; padding-left: 0in; padding-right: 0in; border-top: #ece9d8; border-right: #ece9d8; padding-top: 0in&quot; valign=&quot;top&quot;&gt;\r\n            &lt;p style=&quot;line-height: normal; margin: 0in 0in 0pt&quot; class=&quot;MsoNormal&quot;&gt;&lt;span style=&quot;font-family: ''Arial'',''sans-serif''; font-size: 9pt; mso-fareast-font-family: ''Times New Roman''&quot;&gt;{DELIVERY_CHARGES}&lt;/span&gt;&lt;span style=&quot;font-family: ''Times New Roman'',''serif''; font-size: 12pt; mso-fareast-font-family: ''Times New Roman''&quot;&gt;&lt;o:p&gt;&lt;/o:p&gt;&lt;/span&gt;&lt;/p&gt;\r\n            &lt;/td&gt;\r\n        &lt;/tr&gt;\r\n        &lt;tr style=&quot;mso-yfti-irow: 2&quot;&gt;\r\n            &lt;td style=&quot;border-bottom: #ece9d8; border-left: #ece9d8; padding-bottom: 0in; background-color: transparent; padding-left: 0in; width: 50%; padding-right: 0in; border-top: #ece9d8; border-right: #ece9d8; padding-top: 0in&quot; valign=&quot;top&quot; width=&quot;50%&quot;&gt;\r\n            &lt;p style=&quot;line-height: normal; margin: 0in 0in 0pt&quot; class=&quot;MsoNormal&quot;&gt;&lt;span style=&quot;font-family: ''Times New Roman'',''serif''; font-size: 12pt; mso-fareast-font-family: ''Times New Roman''&quot;&gt;VAT&lt;o:p&gt;&lt;/o:p&gt;&lt;/span&gt;&lt;/p&gt;\r\n            &lt;/td&gt;\r\n            &lt;td style=&quot;border-bottom: #ece9d8; border-left: #ece9d8; padding-bottom: 0in; background-color: transparent; padding-left: 0in; padding-right: 0in; border-top: #ece9d8; border-right: #ece9d8; padding-top: 0in&quot; valign=&quot;top&quot;&gt;\r\n            &lt;p style=&quot;line-height: normal; margin: 0in 0in 0pt&quot; class=&quot;MsoNormal&quot;&gt;&lt;span style=&quot;font-family: ''Arial'',''sans-serif''; font-size: 9pt; mso-fareast-font-family: ''Times New Roman''&quot;&gt;{ORDER_VAT}&lt;/span&gt;&lt;span style=&quot;font-family: ''Times New Roman'',''serif''; font-size: 12pt; mso-fareast-font-family: ''Times New Roman''&quot;&gt;&lt;o:p&gt;&lt;/o:p&gt;&lt;/span&gt;&lt;/p&gt;\r\n            &lt;/td&gt;\r\n        &lt;/tr&gt;\r\n        &lt;tr style=&quot;mso-yfti-irow: 3; mso-yfti-lastrow: yes&quot;&gt;\r\n            &lt;td style=&quot;border-bottom: #ece9d8; border-left: #ece9d8; padding-bottom: 0in; background-color: transparent; padding-left: 0in; width: 50%; padding-right: 0in; border-top: #ece9d8; border-right: #ece9d8; padding-top: 0in&quot; valign=&quot;top&quot; width=&quot;50%&quot;&gt;\r\n            &lt;p style=&quot;line-height: normal; margin: 0in 0in 0pt&quot; class=&quot;MsoNormal&quot;&gt;&lt;span style=&quot;font-family: ''Times New Roman'',''serif''; font-size: 12pt; mso-fareast-font-family: ''Times New Roman''&quot;&gt;Total Cost&lt;o:p&gt;&lt;/o:p&gt;&lt;/span&gt;&lt;/p&gt;\r\n            &lt;/td&gt;\r\n            &lt;td style=&quot;border-bottom: #ece9d8; border-left: #ece9d8; padding-bottom: 0in; background-color: transparent; padding-left: 0in; padding-right: 0in; border-top: #ece9d8; border-right: #ece9d8; padding-top: 0in&quot; valign=&quot;top&quot;&gt;\r\n            &lt;p style=&quot;line-height: normal; margin: 0in 0in 0pt&quot; class=&quot;MsoNormal&quot;&gt;&lt;span style=&quot;font-family: ''Arial Unicode MS'',''sans-serif''; font-size: 9pt; mso-fareast-font-family: Calibri; mso-fareast-theme-font: minor-latin&quot;&gt;{TOTAL_COST}&lt;/span&gt;&lt;span style=&quot;font-family: ''Times New Roman'',''serif''; font-size: 12pt; mso-fareast-font-family: ''Times New Roman''&quot;&gt;&lt;o:p&gt;&lt;/o:p&gt;&lt;/span&gt;&lt;/p&gt;\r\n            &lt;/td&gt;\r\n        &lt;/tr&gt;\r\n    &lt;/tbody&gt;\r\n&lt;/table&gt;\r\n&lt;/p&gt;\r\n&lt;p style=&quot;line-height: normal; margin: 0in 0in 0pt&quot; class=&quot;MsoNormal&quot;&gt;&lt;span style=&quot;font-family: ''Times New Roman'',''serif''; font-size: 12pt; mso-fareast-font-family: ''Times New Roman''&quot;&gt;Should you have any problems please do not hesitate to contact us.&lt;o:p&gt;&lt;/o:p&gt;&lt;/span&gt;&lt;/p&gt;\r\n&lt;p&gt;\r\n&lt;table style=&quot;width: 100%; mso-cellspacing: .7pt; mso-yfti-tbllook: 1184; mso-padding-alt: 0in 0in 0in 0in&quot; class=&quot;MsoNormalTable&quot; border=&quot;0&quot; cellspacing=&quot;1&quot; cellpadding=&quot;0&quot; width=&quot;100%&quot;&gt;\r\n    &lt;tbody&gt;\r\n        &lt;tr style=&quot;mso-yfti-irow: 0; mso-yfti-firstrow: yes&quot;&gt;\r\n            &lt;td style=&quot;border-bottom: #ece9d8; border-left: #ece9d8; padding-bottom: 0in; background-color: transparent; padding-left: 0in; width: 50%; padding-right: 0in; border-top: #ece9d8; border-right: #ece9d8; padding-top: 0in&quot; valign=&quot;top&quot; width=&quot;50%&quot;&gt;\r\n            &lt;p style=&quot;line-height: normal; margin: 0in 0in 0pt&quot; class=&quot;MsoNormal&quot;&gt;&lt;span style=&quot;font-family: ''Times New Roman'',''serif''; font-size: 12pt; mso-fareast-font-family: ''Times New Roman''&quot;&gt;Address&lt;o:p&gt;&lt;/o:p&gt;&lt;/span&gt;&lt;/p&gt;\r\n            &lt;/td&gt;\r\n            &lt;td style=&quot;border-bottom: #ece9d8; border-left: #ece9d8; padding-bottom: 0in; background-color: transparent; padding-left: 0in; padding-right: 0in; border-top: #ece9d8; border-right: #ece9d8; padding-top: 0in&quot; valign=&quot;top&quot;&gt;\r\n            &lt;p style=&quot;line-height: normal; margin: 0in 0in 0pt&quot; class=&quot;MsoNormal&quot;&gt;&lt;span style=&quot;font-family: ''Arial'',''sans-serif''; font-size: 9pt; mso-fareast-font-family: ''Times New Roman''&quot;&gt;{CONTACT_ADDRESS1}&lt;/span&gt;&lt;span style=&quot;font-family: ''Times New Roman'',''serif''; font-size: 12pt; mso-fareast-font-family: ''Times New Roman''&quot;&gt;&lt;br /&gt;\r\n            &lt;/span&gt;&lt;span style=&quot;font-family: ''Arial'',''sans-serif''; font-size: 9pt; mso-fareast-font-family: ''Times New Roman''&quot;&gt;{CONTACT_ADDRESs2&lt;/span&gt;&lt;span style=&quot;font-family: ''Times New Roman'',''serif''; font-size: 12pt; mso-fareast-font-family: ''Times New Roman''&quot;&gt;}&lt;o:p&gt;&lt;/o:p&gt;&lt;/span&gt;&lt;/p&gt;\r\n            &lt;p style=&quot;line-height: normal; margin: 0in 0in 0pt&quot; class=&quot;MsoNormal&quot;&gt;&lt;span style=&quot;font-family: ''Arial'',''sans-serif''; font-size: 9pt; mso-fareast-font-family: ''Times New Roman''&quot;&gt;{CONTACT_CITY}&lt;/span&gt;&lt;span style=&quot;font-family: ''Times New Roman'',''serif''; font-size: 12pt; mso-fareast-font-family: ''Times New Roman''&quot;&gt;&lt;br /&gt;\r\n            &lt;/span&gt;&lt;span style=&quot;font-family: ''Arial'',''sans-serif''; font-size: 9pt; mso-fareast-font-family: ''Times New Roman''&quot;&gt;{CONTACT_ZIPCODE}&lt;/span&gt;&lt;span style=&quot;font-family: ''Times New Roman'',''serif''; font-size: 12pt; mso-fareast-font-family: ''Times New Roman''&quot;&gt;&lt;o:p&gt;&lt;/o:p&gt;&lt;/span&gt;&lt;/p&gt;\r\n            &lt;/td&gt;\r\n        &lt;/tr&gt;\r\n        &lt;tr style=&quot;mso-yfti-irow: 1&quot;&gt;\r\n            &lt;td style=&quot;border-bottom: #ece9d8; border-left: #ece9d8; padding-bottom: 0in; background-color: transparent; padding-left: 0in; width: 50%; padding-right: 0in; border-top: #ece9d8; border-right: #ece9d8; padding-top: 0in&quot; valign=&quot;top&quot; width=&quot;50%&quot;&gt;\r\n            &lt;p style=&quot;line-height: normal; margin: 0in 0in 0pt&quot; class=&quot;MsoNormal&quot;&gt;&lt;span style=&quot;font-family: ''Times New Roman'',''serif''; font-size: 12pt; mso-fareast-font-family: ''Times New Roman''&quot;&gt;E-mail&lt;o:p&gt;&lt;/o:p&gt;&lt;/span&gt;&lt;/p&gt;\r\n            &lt;/td&gt;\r\n            &lt;td style=&quot;border-bottom: #ece9d8; border-left: #ece9d8; padding-bottom: 0in; background-color: transparent; padding-left: 0in; padding-right: 0in; border-top: #ece9d8; border-right: #ece9d8; padding-top: 0in&quot; valign=&quot;top&quot;&gt;\r\n            &lt;p style=&quot;line-height: normal; margin: 0in 0in 0pt&quot; class=&quot;MsoNormal&quot;&gt;&lt;span style=&quot;font-family: ''Arial'',''sans-serif''; font-size: 9pt; mso-fareast-font-family: ''Times New Roman''&quot;&gt;{CONTACT_EMAIL}&lt;/span&gt;&lt;span style=&quot;font-family: ''Times New Roman'',''serif''; font-size: 12pt; mso-fareast-font-family: ''Times New Roman''&quot;&gt;&lt;o:p&gt;&lt;/o:p&gt;&lt;/span&gt;&lt;/p&gt;\r\n            &lt;/td&gt;\r\n        &lt;/tr&gt;\r\n        &lt;tr style=&quot;mso-yfti-irow: 2&quot;&gt;\r\n            &lt;td style=&quot;border-bottom: #ece9d8; border-left: #ece9d8; padding-bottom: 0in; background-color: transparent; padding-left: 0in; width: 50%; padding-right: 0in; border-top: #ece9d8; border-right: #ece9d8; padding-top: 0in&quot; valign=&quot;top&quot; width=&quot;50%&quot;&gt;\r\n            &lt;p style=&quot;line-height: normal; margin: 0in 0in 0pt&quot; class=&quot;MsoNormal&quot;&gt;&lt;span style=&quot;font-family: ''Times New Roman'',''serif''; font-size: 12pt; mso-fareast-font-family: ''Times New Roman''&quot;&gt;Web&lt;o:p&gt;&lt;/o:p&gt;&lt;/span&gt;&lt;/p&gt;\r\n            &lt;/td&gt;\r\n            &lt;td style=&quot;border-bottom: #ece9d8; border-left: #ece9d8; padding-bottom: 0in; background-color: transparent; padding-left: 0in; padding-right: 0in; border-top: #ece9d8; border-right: #ece9d8; padding-top: 0in&quot; valign=&quot;top&quot;&gt;\r\n            &lt;p style=&quot;line-height: normal; margin: 0in 0in 0pt&quot; class=&quot;MsoNormal&quot;&gt;&lt;span style=&quot;font-family: ''Arial'',''sans-serif''; font-size: 9pt; mso-fareast-font-family: ''Times New Roman''&quot;&gt;{CONTACT_WEB}&lt;/span&gt;&lt;span style=&quot;font-family: ''Times New Roman'',''serif''; font-size: 12pt; mso-fareast-font-family: ''Times New Roman''&quot;&gt;&lt;o:p&gt;&lt;/o:p&gt;&lt;/span&gt;&lt;/p&gt;\r\n            &lt;/td&gt;\r\n        &lt;/tr&gt;\r\n        &lt;tr style=&quot;mso-yfti-irow: 3; mso-yfti-lastrow: yes&quot;&gt;\r\n            &lt;td style=&quot;border-bottom: #ece9d8; border-left: #ece9d8; padding-bottom: 0in; background-color: transparent; padding-left: 0in; padding-right: 0in; border-top: #ece9d8; border-right: #ece9d8; padding-top: 0in&quot; valign=&quot;top&quot;&gt;\r\n            &lt;p style=&quot;line-height: normal; margin: 0in 0in 0pt&quot; class=&quot;MsoNormal&quot;&gt;&lt;span style=&quot;font-family: ''Times New Roman'',''serif''; font-size: 12pt; mso-fareast-font-family: ''Times New Roman''&quot;&gt;Telephone&lt;o:p&gt;&lt;/o:p&gt;&lt;/span&gt;&lt;/p&gt;\r\n            &lt;/td&gt;\r\n            &lt;td style=&quot;border-bottom: #ece9d8; border-left: #ece9d8; padding-bottom: 0in; background-color: transparent; padding-left: 0in; padding-right: 0in; border-top: #ece9d8; border-right: #ece9d8; padding-top: 0in&quot; valign=&quot;top&quot;&gt;\r\n            &lt;p style=&quot;line-height: normal; margin: 0in 0in 0pt&quot; class=&quot;MsoNormal&quot;&gt;&lt;span style=&quot;font-family: ''Arial'',''sans-serif''; font-size: 9pt; mso-fareast-font-family: ''Times New Roman''&quot;&gt;{CONTACT_PHONE}&lt;/span&gt;&lt;span style=&quot;font-family: ''Times New Roman'',''serif''; font-size: 12pt; mso-fareast-font-family: ''Times New Roman''&quot;&gt;&lt;o:p&gt;&lt;/o:p&gt;&lt;/span&gt;&lt;/p&gt;\r\n            &lt;/td&gt;\r\n        &lt;/tr&gt;\r\n    &lt;/tbody&gt;\r\n&lt;/table&gt;\r\n&lt;/p&gt;\r\n&lt;p style=&quot;margin: 0in 0in 10pt&quot; class=&quot;MsoNormal&quot;&gt;&lt;span style=&quot;line-height: 115%; font-family: ''Times New Roman'',''serif''; font-size: 12pt; mso-fareast-font-family: ''Times New Roman''&quot;&gt;Order Tracking - You can check progress of your order at &lt;/span&gt;&lt;span style=&quot;line-height: 115%; font-family: ''Arial'',''sans-serif''; font-size: 9pt; mso-fareast-font-family: ''Times New Roman''&quot;&gt;{ACCOUNT_URL}.&lt;/span&gt;&lt;span style=&quot;line-height: 115%; font-family: ''Times New Roman'',''serif''; font-size: 12pt; mso-fareast-font-family: ''Times New Roman''&quot;&gt; If you placed your order using the Express Check-out you can request a password to enable tracking - simply click &lt;/span&gt;&lt;span style=&quot;line-height: 115%; font-family: ''Arial'',''sans-serif''; font-size: 9pt; mso-fareast-font-family: ''Times New Roman''&quot;&gt;{FORGOT_PASSWORD_URL}&lt;/span&gt;&lt;/p&gt;\r\n&lt;p style=&quot;margin: 0in 0in 10pt&quot; class=&quot;MsoNormal&quot;&gt;&amp;nbsp;&lt;/p&gt;\r\n&lt;p&gt;Best Regards,&lt;/p&gt;\r\n&lt;p&gt;{SITE_NAME}&lt;/p&gt;', 'HTML'),
(4, 'Order Payment Status', 'Order Status Changed', '&lt;p&gt;&amp;nbsp;&lt;span style=&quot;font-family: ''Arial'',''sans-serif''; font-size: 9pt&quot;&gt;This e-mail is confidential and contains privileged information. If you are not the named recipient, please e-mail or phone us immediately. You should not disclose the contents to any person, take copies, or use it for any purpose. Dear {FIRST_NAME} {LAST_NAME}Order date: {ORDER_DATE}. Your order payment status &lt;span style=&quot;mso-spacerun: yes&quot;&gt;&amp;nbsp;&lt;/span&gt;is {ORDER_STATUS}&lt;/span&gt;&lt;span style=&quot;font-family: ''Arial'',''sans-serif''; font-size: 9pt&quot;&gt;Your current order shipping status is:&amp;nbsp;{ORDER_STATUS}&lt;o:p&gt;&lt;/o:p&gt;&lt;/span&gt;&lt;/p&gt;\r\n&lt;p&gt;&lt;span style=&quot;font-family: ''Arial'',''sans-serif''; font-size: 9pt&quot;&gt;&lt;span style=&quot;mso-spacerun: yes&quot;&gt;&amp;nbsp;&lt;/span&gt;Our contact details are given below in case you have any complaints or questions:&lt;o:p&gt;&lt;/o:p&gt;&lt;/span&gt;&lt;/p&gt;\r\n&lt;p&gt;&lt;span style=&quot;font-family: ''Arial'',''sans-serif''; font-size: 9pt&quot;&gt;&lt;span style=&quot;mso-spacerun: yes&quot;&gt;&amp;nbsp;&lt;/span&gt;Email:&amp;nbsp;{SALES_EMAIL} &lt;o:p&gt;&lt;/o:p&gt;&lt;/span&gt;&lt;/p&gt;\r\n&lt;p&gt;&lt;span style=&quot;font-family: ''Arial'',''sans-serif''; font-size: 9pt&quot;&gt;Phone:&amp;nbsp;{CONTACT_US}&lt;o:p&gt;&lt;/o:p&gt;&lt;/span&gt;&lt;/p&gt;\r\n&lt;p&gt;&lt;span style=&quot;font-family: ''Arial'',''sans-serif''; font-size: 9pt&quot;&gt;Best Regards,&lt;o:p&gt;&lt;/o:p&gt;&lt;/span&gt;&lt;/p&gt;\r\n&lt;p&gt;&lt;span style=&quot;font-family: ''Arial'',''sans-serif''; font-size: 9pt&quot;&gt;{SITE_NAME}&lt;o:p&gt;&lt;/o:p&gt;&lt;/span&gt;&lt;/p&gt;', 'HTML'),
(5, 'Change Password', 'Reset your password', '&lt;p&gt;***This is an automated email, please do not reply***&lt;/p&gt;\r\n&lt;p&gt;&amp;nbsp;Hi, {FIRST_NAME} {LAST_NAME}&lt;/p&gt;\r\n&lt;p&gt;Please click the below given link to reset your password.&lt;/p&gt;\r\n&lt;p&gt;&lt;span style=&quot;widows: 2; text-transform: none; text-indent: 0px; border-collapse: separate; font: medium ''Times New Roman''; white-space: normal; orphans: 2; letter-spacing: normal; color: rgb(0,0,0); word-spacing: 0px; -webkit-border-horizontal-spacing: 0px; -webkit-border-vertical-spacing: 0px; -webkit-text-decorations-in-effect: none; -webkit-text-size-adjust: auto; -webkit-text-stroke-width: 0px&quot; class=&quot;Apple-style-span&quot;&gt;&lt;span style=&quot;border-collapse: collapse; font-family: arial, sans-serif; font-size: 13px&quot; class=&quot;Apple-style-span&quot;&gt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;gt;&amp;gt;&amp;gt;&amp;gt;&amp;gt;&amp;gt;&amp;gt;&amp;gt;&amp;gt;&amp;gt;&amp;gt;&amp;gt;&amp;gt;&amp;gt;&amp;gt;&amp;gt;&amp;gt;&amp;gt;&amp;gt;&amp;gt;&amp;gt;&amp;gt;&amp;gt;&amp;gt;&amp;gt;&lt;/span&gt;&lt;/span&gt;&lt;/p&gt;\r\n&lt;p&gt;&amp;nbsp;{CHANGE_URL}&lt;/p&gt;\r\n&lt;p&gt;&lt;span style=&quot;widows: 2; text-transform: none; text-indent: 0px; border-collapse: separate; font: medium ''Times New Roman''; white-space: normal; orphans: 2; letter-spacing: normal; color: rgb(0,0,0); word-spacing: 0px; -webkit-border-horizontal-spacing: 0px; -webkit-border-vertical-spacing: 0px; -webkit-text-decorations-in-effect: none; -webkit-text-size-adjust: auto; -webkit-text-stroke-width: 0px&quot; class=&quot;Apple-style-span&quot;&gt;&lt;span style=&quot;border-collapse: collapse; font-family: arial, sans-serif; font-size: 13px&quot; class=&quot;Apple-style-span&quot;&gt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;gt;&amp;gt;&amp;gt;&amp;gt;&amp;gt;&amp;gt;&amp;gt;&amp;gt;&amp;gt;&amp;gt;&amp;gt;&amp;gt;&amp;gt;&amp;gt;&amp;gt;&amp;gt;&amp;gt;&amp;gt;&amp;gt;&amp;gt;&amp;gt;&amp;gt;&amp;gt;&amp;gt;&lt;/span&gt;&lt;/span&gt;&lt;/p&gt;\r\n&lt;p&gt;&amp;nbsp;If you did not setup this account please email us at&amp;nbsp;{SALES_EMAIL}&lt;/p&gt;\r\n&lt;p&gt;Best Regards,&lt;/p&gt;\r\n&lt;p&gt;{SITE_NAME}&lt;/p&gt;', 'HTML'),
(6, 'Verify On Register', 'Please confirm your email address.', '&lt;p&gt;***This is an automated email, please do not reply***&lt;/p&gt;\r\n&lt;p&gt;Hi {FIRST_NAME} {LAST_NAME}, &amp;nbsp;&lt;/p&gt;\r\n&lt;p&gt;Please click the link below to activate your website account. If the link is not clickable then copy and paste the link into the address bar in your browser.&lt;/p&gt;\r\n&lt;p&gt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;gt;&amp;gt;&amp;gt;&amp;gt;&amp;gt;&amp;gt;&amp;gt;&amp;gt;&amp;gt;&amp;gt;&amp;gt;&amp;gt;&amp;gt;&amp;gt;&amp;gt;&amp;gt;&amp;gt;&amp;gt;&amp;gt;&amp;gt;&amp;gt;&amp;gt;&amp;gt;&amp;gt;&amp;gt;&lt;/p&gt;\r\n&lt;p&gt;{CONFIRM_URL}&lt;/p&gt;\r\n&lt;p&gt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;gt;&amp;gt;&amp;gt;&amp;gt;&amp;gt;&amp;gt;&amp;gt;&amp;gt;&amp;gt;&amp;gt;&amp;gt;&amp;gt;&amp;gt;&amp;gt;&amp;gt;&amp;gt;&amp;gt;&amp;gt;&amp;gt;&amp;gt;&amp;gt;&amp;gt;&amp;gt;&amp;gt;&amp;gt;&lt;/p&gt;\r\n&lt;p&gt;If you did not setup this account please email us at {SALES_EMAIL}&lt;/p&gt;\r\n&lt;p&gt;Best Regards,&lt;/p&gt;\r\n&lt;p&gt;{SITE_NAME}&lt;/p&gt;', 'HTML'),
(7, 'Resend Email', 'Resend login details', '&lt;p&gt;***This is an automated email, please do not reply***&lt;/p&gt;\r\n&lt;p&gt;&amp;nbsp;Hi {FIRST_NAME} {LAST_NAME},&lt;/p&gt;\r\n&lt;p&gt;Please click the link below to activate your website account. If the link is not clickable then copy and paste the link into the address bar in your browser.&lt;/p&gt;\r\n&lt;p&gt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;gt;&amp;gt;&amp;gt;&amp;gt;&amp;gt;&amp;gt;&amp;gt;&amp;gt;&amp;gt;&amp;gt;&amp;gt;&amp;gt;&amp;gt;&amp;gt;&amp;gt;&amp;gt;&amp;gt;&amp;gt;&amp;gt;&amp;gt;&amp;gt;&amp;gt;&amp;gt;&amp;gt;&amp;gt;&amp;nbsp;&lt;/p&gt;\r\n&lt;p&gt;{RESEND_URL}&lt;/p&gt;\r\n&lt;p&gt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;gt;&amp;gt;&amp;gt;&amp;gt;&amp;gt;&amp;gt;&amp;gt;&amp;gt;&amp;gt;&amp;gt;&amp;gt;&amp;gt;&amp;gt;&amp;gt;&amp;gt;&amp;gt;&amp;gt;&amp;gt;&amp;gt;&amp;gt;&amp;gt;&amp;gt;&amp;gt;&amp;gt;&amp;gt;&lt;/p&gt;\r\n&lt;p&gt;If you did not setup this account please email us at {SALES_EMAIL}&lt;/p&gt;\r\n&lt;p&gt;&amp;nbsp;&lt;/p&gt;\r\n&lt;p&gt;Best Regards,&lt;/p&gt;\r\n&lt;p&gt;{SITE_NAME}&lt;/p&gt;', 'HTML'),
(8, 'Reset Email', 'Reset Your Email', '&lt;p&gt;&amp;nbsp;&lt;/p&gt;\r\n&lt;p&gt;&lt;span style=&quot;font-family: ''Arial'',''sans-serif''; font-size: 9pt&quot;&gt;***This is an automated email, please do not reply***&lt;o:p&gt;&lt;/o:p&gt;&lt;/span&gt;&lt;/p&gt;\r\n&lt;p&gt;&lt;span style=&quot;font-family: ''Arial'',''sans-serif''; font-size: 9pt&quot;&gt;&lt;span style=&quot;mso-spacerun: yes&quot;&gt;&amp;nbsp;&lt;/span&gt;Hi {FIRST_NAME} {LAST_NAME},&lt;o:p&gt;&lt;/o:p&gt;&lt;/span&gt;&lt;/p&gt;\r\n&lt;p&gt;&lt;span style=&quot;font-family: ''Arial'',''sans-serif''; font-size: 9pt&quot;&gt;&lt;span style=&quot;mso-spacerun: yes&quot;&gt;&amp;nbsp;&lt;/span&gt;Please click the link below to activate your website account. If the link is not clickable then copy and paste the link into the address bar in your browser. &lt;o:p&gt;&lt;/o:p&gt;&lt;/span&gt;&lt;/p&gt;\r\n&lt;p&gt;&lt;span style=&quot;font-family: ''Arial'',''sans-serif''; font-size: 9pt&quot;&gt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;gt;&amp;gt;&amp;gt;&amp;gt;&amp;gt;&amp;gt;&amp;gt;&amp;gt;&amp;gt;&amp;gt;&amp;gt;&amp;gt;&amp;gt;&amp;gt;&amp;gt;&amp;gt;&amp;gt;&amp;gt;&amp;gt;&amp;gt;&amp;gt;&amp;gt;&amp;gt;&amp;gt;&amp;gt;&lt;o:p&gt;&amp;nbsp;&lt;/o:p&gt;&lt;/span&gt;&lt;/p&gt;\r\n&lt;p&gt;&lt;span style=&quot;font-family: ''Arial'',''sans-serif''; font-size: 9pt&quot;&gt;{RESET_URL}&lt;o:p&gt;&lt;/o:p&gt;&lt;/span&gt;&lt;/p&gt;\r\n&lt;p&gt;&lt;span style=&quot;font-family: ''Arial'',''sans-serif''; font-size: 9pt&quot;&gt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;gt;&amp;gt;&amp;gt;&amp;gt;&amp;gt;&amp;gt;&amp;gt;&amp;gt;&amp;gt;&amp;gt;&amp;gt;&amp;gt;&amp;gt;&amp;gt;&amp;gt;&amp;gt;&amp;gt;&amp;gt;&amp;gt;&amp;gt;&amp;gt;&amp;gt;&amp;gt;&amp;gt;&amp;gt;&lt;o:p&gt;&amp;nbsp;&lt;/o:p&gt;&lt;/span&gt;&lt;/p&gt;\r\n&lt;p&gt;&lt;span style=&quot;font-family: ''Arial'',''sans-serif''; font-size: 9pt&quot;&gt;If you did not setup this account please email us at {SALES_EMAIL}&lt;o:p&gt;&lt;/o:p&gt;&lt;/span&gt;&lt;/p&gt;\r\n&lt;p&gt;&lt;span style=&quot;font-family: ''Arial'',''sans-serif''; font-size: 9pt&quot;&gt;Best Regards,&lt;o:p&gt;&lt;/o:p&gt;&lt;/span&gt;&lt;/p&gt;\r\n&lt;p&gt;&lt;span style=&quot;font-family: ''Arial'',''sans-serif''; font-size: 9pt&quot;&gt;{SITE_NAME}&lt;o:p&gt;&lt;/o:p&gt;&lt;/span&gt;&lt;/p&gt;', 'HTML'),
(9, 'Login Detail', 'Login details', '&lt;p&gt;***This is an automated email, please do not reply***&lt;/p&gt;\r\n&lt;p&gt;Hi ,{FIRST_NAME} {LAST_NAME},&lt;/p&gt;\r\n&lt;p&gt;Your login details for your website account are:&lt;/p&gt;\r\n&lt;p&gt;Username: {USER}&lt;/p&gt;\r\n&lt;p&gt;Password: {PASSWORD}&lt;/p&gt;\r\n&lt;p&gt;***Please keep your account details safe and secure***&lt;/p&gt;\r\n&lt;p&gt;{SITE_NAME}&lt;/p&gt;', 'HTML');
INSERT INTO `email` (`id`, `email_name`, `email_subject`, `email_text`, `email_type`) VALUES
(10, 'Order Status Changed', 'Order Status Changed', '&lt;p class=&quot;MsoNormal&quot; style=&quot;margin: 0in 0in 10pt&quot;&gt;\r\n	&lt;span style=&quot;font-family: ''Arial'',''sans-serif''; font-size: 9pt; mso-fareast-font-family: ''Times New Roman''&quot;&gt;This e-mail is confidential and contains privileged information. If you are not the named recipient, please e-mail or phone us immediately. You should not disclose the contents to any person, take copies, or use it for any purpose. &lt;/span&gt;&lt;/p&gt;\r\n&lt;p class=&quot;MsoNormal&quot; style=&quot;margin: 0in 0in 10pt&quot;&gt;\r\n	&lt;span style=&quot;font-family: ''Arial'',''sans-serif''; font-size: 9pt; mso-fareast-font-family: ''Times New Roman''&quot;&gt;Dear {FIRST_NAME} {LAST_NAME} &lt;/span&gt;&lt;/p&gt;\r\n&lt;p class=&quot;MsoNormal&quot; style=&quot;margin: 0in 0in 10pt&quot;&gt;\r\n	&lt;span style=&quot;font-family: ''Arial'',''sans-serif''; font-size: 9pt; mso-fareast-font-family: ''Times New Roman''&quot;&gt;Order date: {ORDER_DATE}. &lt;/span&gt;&lt;/p&gt;\r\n&lt;p class=&quot;MsoNormal&quot; style=&quot;margin: 0in 0in 10pt&quot;&gt;\r\n	&lt;span style=&quot;font-family: ''Arial'',''sans-serif''; font-size: 9pt; mso-fareast-font-family: ''Times New Roman''&quot;&gt;Your order payment status has successfully been {RECEIVED} . &lt;/span&gt;&lt;/p&gt;\r\n&lt;p class=&quot;MsoNormal&quot; style=&quot;margin: 0in 0in 10pt&quot;&gt;\r\n	&lt;span style=&quot;font-family: ''Arial'',''sans-serif''; font-size: 9pt; mso-fareast-font-family: ''Times New Roman''&quot;&gt;Your current order shipping status is:{RECEIVED}&lt;/span&gt;&lt;/p&gt;\r\n&lt;p class=&quot;MsoNormal&quot; style=&quot;margin: 0in 0in 10pt&quot;&gt;\r\n	&lt;span style=&quot;font-family: ''Arial'',''sans-serif''; font-size: 9pt; mso-fareast-font-family: ''Times New Roman''&quot;&gt;&lt;o:p&gt;&lt;/o:p&gt;&lt;/span&gt;&lt;/p&gt;\r\n&lt;p class=&quot;MsoNormal&quot; style=&quot;line-height: normal; margin: 0in 0in 10pt&quot;&gt;\r\n	&amp;nbsp;&lt;/p&gt;\r\n&lt;p class=&quot;MsoNormal&quot; style=&quot;line-height: normal; margin: 0in 0in 10pt&quot;&gt;\r\n	&lt;span style=&quot;font-family: ''Arial'',''sans-serif''; font-size: 9pt; mso-fareast-font-family: ''Times New Roman''&quot;&gt;Our contact details are given below in case you have any complaints or questions: Email: &lt;/span&gt;&lt;span style=&quot;font-family: ''Times New Roman'',''serif''; font-size: 12pt; mso-fareast-font-family: ''Times New Roman''&quot;&gt;&lt;o:p&gt;&lt;/o:p&gt;&lt;/span&gt;&lt;/p&gt;\r\n&lt;p&gt;\r\n	&lt;span style=&quot;font-family: ''Arial'',''sans-serif''; font-size: 9pt&quot;&gt;Email:&amp;nbsp;{SALES_EMAIL} &lt;o:p&gt;&lt;/o:p&gt;&lt;/span&gt;&lt;/p&gt;\r\n&lt;p&gt;\r\n	&lt;span style=&quot;font-family: ''Arial'',''sans-serif''; font-size: 9pt&quot;&gt;Phone:&amp;nbsp;{CONTACT_US}&lt;/span&gt;&lt;/p&gt;\r\n&lt;p&gt;\r\n	&lt;span style=&quot;font-family: ''Arial'',''sans-serif''; font-size: 9pt&quot;&gt;&lt;o:p&gt;&lt;/o:p&gt;&lt;/span&gt;&lt;/p&gt;\r\n&lt;p&gt;\r\n	&amp;nbsp;&lt;/p&gt;\r\n&lt;p&gt;\r\n	&lt;strong&gt;&lt;span style=&quot;font-family: ''Arial'',''sans-serif''; font-size: 9pt&quot;&gt;Best Regards,&lt;/span&gt;&lt;/strong&gt;&lt;/p&gt;\r\n&lt;p&gt;\r\n	&lt;span style=&quot;font-family: ''Arial'',''sans-serif''; font-size: 9pt&quot;&gt;{SITE_NAME}&lt;o:p&gt;&lt;/o:p&gt;&lt;/span&gt;&lt;/p&gt;\r\n', 'HTML'),
(11, 'Mail To Friend', 'Mail To Friend', '&lt;p&gt;***This is an automated email, please do not reply***&lt;/p&gt;\r\n&lt;p&gt;Hi {FIRST_NAME}&lt;!--[if gte mso 9]&gt;&lt;xml&gt;\r\n&lt;w:LatentStyles DefLockedState=&quot;false&quot; DefUnhideWhenUsed=&quot;true&quot;\r\nDefSemiHidden=&quot;true&quot; DefQFormat=&quot;false&quot; DefPriority=&quot;99&quot;\r\nLatentStyleCount=&quot;267&quot;&gt;\r\n&lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;0&quot; SemiHidden=&quot;false&quot;\r\nUnhideWhenUsed=&quot;false&quot; QFormat=&quot;true&quot; Name=&quot;Normal&quot; /&gt;\r\n&lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;9&quot; SemiHidden=&quot;false&quot;\r\nUnhideWhenUsed=&quot;false&quot; QFormat=&quot;true&quot; Name=&quot;heading 1&quot; /&gt;\r\n&lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;9&quot; QFormat=&quot;true&quot; Name=&quot;heading 2&quot; /&gt;\r\n&lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;9&quot; QFormat=&quot;true&quot; Name=&quot;heading 3&quot; /&gt;\r\n&lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;9&quot; QFormat=&quot;true&quot; Name=&quot;heading 4&quot; /&gt;\r\n&lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;9&quot; QFormat=&quot;true&quot; Name=&quot;heading 5&quot; /&gt;\r\n&lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;9&quot; QFormat=&quot;true&quot; Name=&quot;heading 6&quot; /&gt;\r\n&lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;9&quot; QFormat=&quot;true&quot; Name=&quot;heading 7&quot; /&gt;\r\n&lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;9&quot; QFormat=&quot;true&quot; Name=&quot;heading 8&quot; /&gt;\r\n&lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;9&quot; QFormat=&quot;true&quot; Name=&quot;heading 9&quot; /&gt;\r\n&lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;39&quot; Name=&quot;toc 1&quot; /&gt;\r\n&lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;39&quot; Name=&quot;toc 2&quot; /&gt;\r\n&lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;39&quot; Name=&quot;toc 3&quot; /&gt;\r\n&lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;39&quot; Name=&quot;toc 4&quot; /&gt;\r\n&lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;39&quot; Name=&quot;toc 5&quot; /&gt;\r\n&lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;39&quot; Name=&quot;toc 6&quot; /&gt;\r\n&lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;39&quot; Name=&quot;toc 7&quot; /&gt;\r\n&lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;39&quot; Name=&quot;toc 8&quot; /&gt;\r\n&lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;39&quot; Name=&quot;toc 9&quot; /&gt;\r\n&lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;35&quot; QFormat=&quot;true&quot; Name=&quot;caption&quot; /&gt;\r\n&lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;10&quot; SemiHidden=&quot;false&quot;\r\nUnhideWhenUsed=&quot;false&quot; QFormat=&quot;true&quot; Name=&quot;Title&quot; /&gt;\r\n&lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;1&quot; Name=&quot;Default Paragraph Font&quot; /&gt;\r\n&lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;11&quot; SemiHidden=&quot;false&quot;\r\nUnhideWhenUsed=&quot;false&quot; QFormat=&quot;true&quot; Name=&quot;Subtitle&quot; /&gt;\r\n&lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;22&quot; SemiHidden=&quot;false&quot;\r\nUnhideWhenUsed=&quot;false&quot; QFormat=&quot;true&quot; Name=&quot;Strong&quot; /&gt;\r\n&lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;20&quot; SemiHidden=&quot;false&quot;\r\nUnhideWhenUsed=&quot;false&quot; QFormat=&quot;true&quot; Name=&quot;Emphasis&quot; /&gt;\r\n&lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;59&quot; SemiHidden=&quot;false&quot;\r\nUnhideWhenUsed=&quot;false&quot; Name=&quot;Table Grid&quot; /&gt;\r\n&lt;w:LsdException Locked=&quot;false&quot; UnhideWhenUsed=&quot;false&quot; Name=&quot;Placeholder Text&quot; /&gt;\r\n&lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;1&quot; SemiHidden=&quot;false&quot;\r\nUnhideWhenUsed=&quot;false&quot; QFormat=&quot;true&quot; Name=&quot;No Spacing&quot; /&gt;\r\n&lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;60&quot; SemiHidden=&quot;false&quot;\r\nUnhideWhenUsed=&quot;false&quot; Name=&quot;Light Shading&quot; /&gt;\r\n&lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;61&quot; SemiHidden=&quot;false&quot;\r\nUnhideWhenUsed=&quot;false&quot; Name=&quot;Light List&quot; /&gt;\r\n&lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;62&quot; SemiHidden=&quot;false&quot;\r\nUnhideWhenUsed=&quot;false&quot; Name=&quot;Light Grid&quot; /&gt;\r\n&lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;63&quot; SemiHidden=&quot;false&quot;\r\nUnhideWhenUsed=&quot;false&quot; Name=&quot;Medium Shading 1&quot; /&gt;\r\n&lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;64&quot; SemiHidden=&quot;false&quot;\r\nUnhideWhenUsed=&quot;false&quot; Name=&quot;Medium Shading 2&quot; /&gt;\r\n&lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;65&quot; SemiHidden=&quot;false&quot;\r\nUnhideWhenUsed=&quot;false&quot; Name=&quot;Medium List 1&quot; /&gt;\r\n&lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;66&quot; SemiHidden=&quot;false&quot;\r\nUnhideWhenUsed=&quot;false&quot; Name=&quot;Medium List 2&quot; /&gt;\r\n&lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;67&quot; SemiHidden=&quot;false&quot;\r\nUnhideWhenUsed=&quot;false&quot; Name=&quot;Medium Grid 1&quot; /&gt;\r\n&lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;68&quot; SemiHidden=&quot;false&quot;\r\nUnhideWhenUsed=&quot;false&quot; Name=&quot;Medium Grid 2&quot; /&gt;\r\n&lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;69&quot; SemiHidden=&quot;false&quot;\r\nUnhideWhenUsed=&quot;false&quot; Name=&quot;Medium Grid 3&quot; /&gt;\r\n&lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;70&quot; SemiHidden=&quot;false&quot;\r\nUnhideWhenUsed=&quot;false&quot; Name=&quot;Dark List&quot; /&gt;\r\n&lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;71&quot; SemiHidden=&quot;false&quot;\r\nUnhideWhenUsed=&quot;false&quot; Name=&quot;Colorful Shading&quot; /&gt;\r\n&lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;72&quot; SemiHidden=&quot;false&quot;\r\nUnhideWhenUsed=&quot;false&quot; Name=&quot;Colorful List&quot; /&gt;\r\n&lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;73&quot; SemiHidden=&quot;false&quot;\r\nUnhideWhenUsed=&quot;false&quot; Name=&quot;Colorful Grid&quot; /&gt;\r\n&lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;60&quot; SemiHidden=&quot;false&quot;\r\nUnhideWhenUsed=&quot;false&quot; Name=&quot;Light Shading Accent 1&quot; /&gt;\r\n&lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;61&quot; SemiHidden=&quot;false&quot;\r\nUnhideWhenUsed=&quot;false&quot; Name=&quot;Light List Accent 1&quot; /&gt;\r\n&lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;62&quot; SemiHidden=&quot;false&quot;\r\nUnhideWhenUsed=&quot;false&quot; Name=&quot;Light Grid Accent 1&quot; /&gt;\r\n&lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;63&quot; SemiHidden=&quot;false&quot;\r\nUnhideWhenUsed=&quot;false&quot; Name=&quot;Medium Shading 1 Accent 1&quot; /&gt;\r\n&lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;64&quot; SemiHidden=&quot;false&quot;\r\nUnhideWhenUsed=&quot;false&quot; Name=&quot;Medium Shading 2 Accent 1&quot; /&gt;\r\n&lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;65&quot; SemiHidden=&quot;false&quot;\r\nUnhideWhenUsed=&quot;false&quot; Name=&quot;Medium List 1 Accent 1&quot; /&gt;\r\n&lt;w:LsdException Locked=&quot;false&quot; UnhideWhenUsed=&quot;false&quot; Name=&quot;Revision&quot; /&gt;\r\n&lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;34&quot; SemiHidden=&quot;false&quot;\r\nUnhideWhenUsed=&quot;false&quot; QFormat=&quot;true&quot; Name=&quot;List Paragraph&quot; /&gt;\r\n&lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;29&quot; SemiHidden=&quot;false&quot;\r\nUnhideWhenUsed=&quot;false&quot; QFormat=&quot;true&quot; Name=&quot;Quote&quot; /&gt;\r\n&lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;30&quot; SemiHidden=&quot;false&quot;\r\nUnhideWhenUsed=&quot;false&quot; QFormat=&quot;true&quot; Name=&quot;Intense Quote&quot; /&gt;\r\n&lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;66&quot; SemiHidden=&quot;false&quot;\r\nUnhideWhenUsed=&quot;false&quot; Name=&quot;Medium List 2 Accent 1&quot; /&gt;\r\n&lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;67&quot; SemiHidden=&quot;false&quot;\r\nUnhideWhenUsed=&quot;false&quot; Name=&quot;Medium Grid 1 Accent 1&quot; /&gt;\r\n&lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;68&quot; SemiHidden=&quot;false&quot;\r\nUnhideWhenUsed=&quot;false&quot; Name=&quot;Medium Grid 2 Accent 1&quot; /&gt;\r\n&lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;69&quot; SemiHidden=&quot;false&quot;\r\nUnhideWhenUsed=&quot;false&quot; Name=&quot;Medium Grid 3 Accent 1&quot; /&gt;\r\n&lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;70&quot; SemiHidden=&quot;false&quot;\r\nUnhideWhenUsed=&quot;false&quot; Name=&quot;Dark List Accent 1&quot; /&gt;\r\n&lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;71&quot; SemiHidden=&quot;false&quot;\r\nUnhideWhenUsed=&quot;false&quot; Name=&quot;Colorful Shading Accent 1&quot; /&gt;\r\n&lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;72&quot; SemiHidden=&quot;false&quot;\r\nUnhideWhenUsed=&quot;false&quot; Name=&quot;Colorful List Accent 1&quot; /&gt;\r\n&lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;73&quot; SemiHidden=&quot;false&quot;\r\nUnhideWhenUsed=&quot;false&quot; Name=&quot;Colorful Grid Accent 1&quot; /&gt;\r\n&lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;60&quot; SemiHidden=&quot;false&quot;\r\nUnhideWhenUsed=&quot;false&quot; Name=&quot;Light Shading Accent 2&quot; /&gt;\r\n&lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;61&quot; SemiHidden=&quot;false&quot;\r\nUnhideWhenUsed=&quot;false&quot; Name=&quot;Light List Accent 2&quot; /&gt;\r\n&lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;62&quot; SemiHidden=&quot;false&quot;\r\nUnhideWhenUsed=&quot;false&quot; Name=&quot;Light Grid Accent 2&quot; /&gt;\r\n&lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;63&quot; SemiHidden=&quot;false&quot;\r\nUnhideWhenUsed=&quot;false&quot; Name=&quot;Medium Shading 1 Accent 2&quot; /&gt;\r\n&lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;64&quot; SemiHidden=&quot;false&quot;\r\nUnhideWhenUsed=&quot;false&quot; Name=&quot;Medium Shading 2 Accent 2&quot; /&gt;\r\n&lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;65&quot; SemiHidden=&quot;false&quot;\r\nUnhideWhenUsed=&quot;false&quot; Name=&quot;Medium List 1 Accent 2&quot; /&gt;\r\n&lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;66&quot; SemiHidden=&quot;false&quot;\r\nUnhideWhenUsed=&quot;false&quot; Name=&quot;Medium List 2 Accent 2&quot; /&gt;\r\n&lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;67&quot; SemiHidden=&quot;false&quot;\r\nUnhideWhenUsed=&quot;false&quot; Name=&quot;Medium Grid 1 Accent 2&quot; /&gt;\r\n&lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;68&quot; SemiHidden=&quot;false&quot;\r\nUnhideWhenUsed=&quot;false&quot; Name=&quot;Medium Grid 2 Accent 2&quot; /&gt;\r\n&lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;69&quot; SemiHidden=&quot;false&quot;\r\nUnhideWhenUsed=&quot;false&quot; Name=&quot;Medium Grid 3 Accent 2&quot; /&gt;\r\n&lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;70&quot; SemiHidden=&quot;false&quot;\r\nUnhideWhenUsed=&quot;false&quot; Name=&quot;Dark List Accent 2&quot; /&gt;\r\n&lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;71&quot; SemiHidden=&quot;false&quot;\r\nUnhideWhenUsed=&quot;false&quot; Name=&quot;Colorful Shading Accent 2&quot; /&gt;\r\n&lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;72&quot; SemiHidden=&quot;false&quot;\r\nUnhideWhenUsed=&quot;false&quot; Name=&quot;Colorful List Accent 2&quot; /&gt;\r\n&lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;73&quot; SemiHidden=&quot;false&quot;\r\nUnhideWhenUsed=&quot;false&quot; Name=&quot;Colorful Grid Accent 2&quot; /&gt;\r\n&lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;60&quot; SemiHidden=&quot;false&quot;\r\nUnhideWhenUsed=&quot;false&quot; Name=&quot;Light Shading Accent 3&quot; /&gt;\r\n&lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;61&quot; SemiHidden=&quot;false&quot;\r\nUnhideWhenUsed=&quot;false&quot; Name=&quot;Light List Accent 3&quot; /&gt;\r\n&lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;62&quot; SemiHidden=&quot;false&quot;\r\nUnhideWhenUsed=&quot;false&quot; Name=&quot;Light Grid Accent 3&quot; /&gt;\r\n&lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;63&quot; SemiHidden=&quot;false&quot;\r\nUnhideWhenUsed=&quot;false&quot; Name=&quot;Medium Shading 1 Accent 3&quot; /&gt;\r\n&lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;64&quot; SemiHidden=&quot;false&quot;\r\nUnhideWhenUsed=&quot;false&quot; Name=&quot;Medium Shading 2 Accent 3&quot; /&gt;\r\n&lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;65&quot; SemiHidden=&quot;false&quot;\r\nUnhideWhenUsed=&quot;false&quot; Name=&quot;Medium List 1 Accent 3&quot; /&gt;\r\n&lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;66&quot; SemiHidden=&quot;false&quot;\r\nUnhideWhenUsed=&quot;false&quot; Name=&quot;Medium List 2 Accent 3&quot; /&gt;\r\n&lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;67&quot; SemiHidden=&quot;false&quot;\r\nUnhideWhenUsed=&quot;false&quot; Name=&quot;Medium Grid 1 Accent 3&quot; /&gt;\r\n&lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;68&quot; SemiHidden=&quot;false&quot;\r\nUnhideWhenUsed=&quot;false&quot; Name=&quot;Medium Grid 2 Accent 3&quot; /&gt;\r\n&lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;69&quot; SemiHidden=&quot;false&quot;\r\nUnhideWhenUsed=&quot;false&quot; Name=&quot;Medium Grid 3 Accent 3&quot; /&gt;\r\n&lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;70&quot; SemiHidden=&quot;false&quot;\r\nUnhideWhenUsed=&quot;false&quot; Name=&quot;Dark List Accent 3&quot; /&gt;\r\n&lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;71&quot; SemiHidden=&quot;false&quot;\r\nUnhideWhenUsed=&quot;false&quot; Name=&quot;Colorful Shading Accent 3&quot; /&gt;\r\n&lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;72&quot; SemiHidden=&quot;false&quot;\r\nUnhideWhenUsed=&quot;false&quot; Name=&quot;Colorful List Accent 3&quot; /&gt;\r\n&lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;73&quot; SemiHidden=&quot;false&quot;\r\nUnhideWhenUsed=&quot;false&quot; Name=&quot;Colorful Grid Accent 3&quot; /&gt;\r\n&lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;60&quot; SemiHidden=&quot;false&quot;\r\nUnhideWhenUsed=&quot;false&quot; Name=&quot;Light Shading Accent 4&quot; /&gt;\r\n&lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;61&quot; SemiHidden=&quot;false&quot;\r\nUnhideWhenUsed=&quot;false&quot; Name=&quot;Light List Accent 4&quot; /&gt;\r\n&lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;62&quot; SemiHidden=&quot;false&quot;\r\nUnhideWhenUsed=&quot;false&quot; Name=&quot;Light Grid Accent 4&quot; /&gt;\r\n&lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;63&quot; SemiHidden=&quot;false&quot;\r\nUnhideWhenUsed=&quot;false&quot; Name=&quot;Medium Shading 1 Accent 4&quot; /&gt;\r\n&lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;64&quot; SemiHidden=&quot;false&quot;\r\nUnhideWhenUsed=&quot;false&quot; Name=&quot;Medium Shading 2 Accent 4&quot; /&gt;\r\n&lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;65&quot; SemiHidden=&quot;false&quot;\r\nUnhideWhenUsed=&quot;false&quot; Name=&quot;Medium List 1 Accent 4&quot; /&gt;\r\n&lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;66&quot; SemiHidden=&quot;false&quot;\r\nUnhideWhenUsed=&quot;false&quot; Name=&quot;Medium List 2 Accent 4&quot; /&gt;\r\n&lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;67&quot; SemiHidden=&quot;false&quot;\r\nUnhideWhenUsed=&quot;false&quot; Name=&quot;Medium Grid 1 Accent 4&quot; /&gt;\r\n&lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;68&quot; SemiHidden=&quot;false&quot;\r\nUnhideWhenUsed=&quot;false&quot; Name=&quot;Medium Grid 2 Accent 4&quot; /&gt;\r\n&lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;69&quot; SemiHidden=&quot;false&quot;\r\nUnhideWhenUsed=&quot;false&quot; Name=&quot;Medium Grid 3 Accent 4&quot; /&gt;\r\n&lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;70&quot; SemiHidden=&quot;false&quot;\r\nUnhideWhenUsed=&quot;false&quot; Name=&quot;Dark List Accent 4&quot; /&gt;\r\n&lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;71&quot; SemiHidden=&quot;false&quot;\r\nUnhideWhenUsed=&quot;false&quot; Name=&quot;Colorful Shading Accent 4&quot; /&gt;\r\n&lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;72&quot; SemiHidden=&quot;false&quot;\r\nUnhideWhenUsed=&quot;false&quot; Name=&quot;Colorful List Accent 4&quot; /&gt;\r\n&lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;73&quot; SemiHidden=&quot;false&quot;\r\nUnhideWhenUsed=&quot;false&quot; Name=&quot;Colorful Grid Accent 4&quot; /&gt;\r\n&lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;60&quot; SemiHidden=&quot;false&quot;\r\nUnhideWhenUsed=&quot;false&quot; Name=&quot;Light Shading Accent 5&quot; /&gt;\r\n&lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;61&quot; SemiHidden=&quot;false&quot;\r\nUnhideWhenUsed=&quot;false&quot; Name=&quot;Light List Accent 5&quot; /&gt;\r\n&lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;62&quot; SemiHidden=&quot;false&quot;\r\nUnhideWhenUsed=&quot;false&quot; Name=&quot;Light Grid Accent 5&quot; /&gt;\r\n&lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;63&quot; SemiHidden=&quot;false&quot;\r\nUnhideWhenUsed=&quot;false&quot; Name=&quot;Medium Shading 1 Accent 5&quot; /&gt;\r\n&lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;64&quot; SemiHidden=&quot;false&quot;\r\nUnhideWhenUsed=&quot;false&quot; Name=&quot;Medium Shading 2 Accent 5&quot; /&gt;\r\n&lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;65&quot; SemiHidden=&quot;false&quot;\r\nUnhideWhenUsed=&quot;false&quot; Name=&quot;Medium List 1 Accent 5&quot; /&gt;\r\n&lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;66&quot; SemiHidden=&quot;false&quot;\r\nUnhideWhenUsed=&quot;false&quot; Name=&quot;Medium List 2 Accent 5&quot; /&gt;\r\n&lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;67&quot; SemiHidden=&quot;false&quot;\r\nUnhideWhenUsed=&quot;false&quot; Name=&quot;Medium Grid 1 Accent 5&quot; /&gt;\r\n&lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;68&quot; SemiHidden=&quot;false&quot;\r\nUnhideWhenUsed=&quot;false&quot; Name=&quot;Medium Grid 2 Accent 5&quot; /&gt;\r\n&lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;69&quot; SemiHidden=&quot;false&quot;\r\nUnhideWhenUsed=&quot;false&quot; Name=&quot;Medium Grid 3 Accent 5&quot; /&gt;\r\n&lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;70&quot; SemiHidden=&quot;false&quot;\r\nUnhideWhenUsed=&quot;false&quot; Name=&quot;Dark List Accent 5&quot; /&gt;\r\n&lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;71&quot; SemiHidden=&quot;false&quot;\r\nUnhideWhenUsed=&quot;false&quot; Name=&quot;Colorful Shading Accent 5&quot; /&gt;\r\n&lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;72&quot; SemiHidden=&quot;false&quot;\r\nUnhideWhenUsed=&quot;false&quot; Name=&quot;Colorful List Accent 5&quot; /&gt;\r\n&lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;73&quot; SemiHidden=&quot;false&quot;\r\nUnhideWhenUsed=&quot;false&quot; Name=&quot;Colorful Grid Accent 5&quot; /&gt;\r\n&lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;60&quot; SemiHidden=&quot;false&quot;\r\nUnhideWhenUsed=&quot;false&quot; Name=&quot;Light Shading Accent 6&quot; /&gt;\r\n&lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;61&quot; SemiHidden=&quot;false&quot;\r\nUnhideWhenUsed=&quot;false&quot; Name=&quot;Light List Accent 6&quot; /&gt;\r\n&lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;62&quot; SemiHidden=&quot;false&quot;\r\nUnhideWhenUsed=&quot;false&quot; Name=&quot;Light Grid Accent 6&quot; /&gt;\r\n&lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;63&quot; SemiHidden=&quot;false&quot;\r\nUnhideWhenUsed=&quot;false&quot; Name=&quot;Medium Shading 1 Accent 6&quot; /&gt;\r\n&lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;64&quot; SemiHidden=&quot;false&quot;\r\nUnhideWhenUsed=&quot;false&quot; Name=&quot;Medium Shading 2 Accent 6&quot; /&gt;\r\n&lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;65&quot; SemiHidden=&quot;false&quot;\r\nUnhideWhenUsed=&quot;false&quot; Name=&quot;Medium List 1 Accent 6&quot; /&gt;\r\n&lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;66&quot; SemiHidden=&quot;false&quot;\r\nUnhideWhenUsed=&quot;false&quot; Name=&quot;Medium List 2 Accent 6&quot; /&gt;\r\n&lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;67&quot; SemiHidden=&quot;false&quot;\r\nUnhideWhenUsed=&quot;false&quot; Name=&quot;Medium Grid 1 Accent 6&quot; /&gt;\r\n&lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;68&quot; SemiHidden=&quot;false&quot;\r\nUnhideWhenUsed=&quot;false&quot; Name=&quot;Medium Grid 2 Accent 6&quot; /&gt;\r\n&lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;69&quot; SemiHidden=&quot;false&quot;\r\nUnhideWhenUsed=&quot;false&quot; Name=&quot;Medium Grid 3 Accent 6&quot; /&gt;\r\n&lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;70&quot; SemiHidden=&quot;false&quot;\r\nUnhideWhenUsed=&quot;false&quot; Name=&quot;Dark List Accent 6&quot; /&gt;\r\n&lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;71&quot; SemiHidden=&quot;false&quot;\r\nUnhideWhenUsed=&quot;false&quot; Name=&quot;Colorful Shading Accent 6&quot; /&gt;\r\n&lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;72&quot; SemiHidden=&quot;false&quot;\r\nUnhideWhenUsed=&quot;false&quot; Name=&quot;Colorful List Accent 6&quot; /&gt;\r\n&lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;73&quot; SemiHidden=&quot;false&quot;\r\nUnhideWhenUsed=&quot;false&quot; Name=&quot;Colorful Grid Accent 6&quot; /&gt;\r\n&lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;19&quot; SemiHidden=&quot;false&quot;\r\nUnhideWhenUsed=&quot;false&quot; QFormat=&quot;true&quot; Name=&quot;Subtle Emphasis&quot; /&gt;\r\n&lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;21&quot; SemiHidden=&quot;false&quot;\r\nUnhideWhenUsed=&quot;false&quot; QFormat=&quot;true&quot; Name=&quot;Intense Emphasis&quot; /&gt;\r\n&lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;31&quot; SemiHidden=&quot;false&quot;\r\nUnhideWhenUsed=&quot;false&quot; QFormat=&quot;true&quot; Name=&quot;Subtle Reference&quot; /&gt;\r\n&lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;32&quot; SemiHidden=&quot;false&quot;\r\nUnhideWhenUsed=&quot;false&quot; QFormat=&quot;true&quot; Name=&quot;Intense Reference&quot; /&gt;\r\n&lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;33&quot; SemiHidden=&quot;false&quot;\r\nUnhideWhenUsed=&quot;false&quot; QFormat=&quot;true&quot; Name=&quot;Book Title&quot; /&gt;\r\n&lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;37&quot; Name=&quot;Bibliography&quot; /&gt;\r\n&lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;39&quot; QFormat=&quot;true&quot; Name=&quot;TOC Heading&quot; /&gt;\r\n&lt;/w:LatentStyles&gt;\r\n&lt;/xml&gt;&lt;![endif]--&gt;&lt;!--[if gte mso 10]&gt;\r\n&lt;style&gt;\r\n/* Style Definitions */\r\ntable.MsoNormalTable\r\n{mso-style-name:&quot;Table Normal&quot;;\r\nmso-tstyle-rowband-size:0;\r\nmso-tstyle-colband-size:0;\r\nmso-style-noshow:yes;\r\nmso-style-priority:99;\r\nmso-style-qformat:yes;\r\nmso-style-parent:&quot;&quot;;\r\nmso-padding-alt:0in 5.4pt 0in 5.4pt;\r\nmso-para-margin-top:0in;\r\nmso-para-margin-right:0in;\r\nmso-para-margin-bottom:10.0pt;\r\nmso-para-margin-left:0in;\r\nline-height:115%;\r\nmso-pagination:widow-orphan;\r\nfont-size:11.0pt;\r\nfont-family:&quot;Calibri&quot;,&quot;sans-serif&quot;;\r\nmso-ascii-font-family:Calibri;\r\nmso-ascii-theme-font:minor-latin;\r\nmso-fareast-font-family:&quot;Times New Roman&quot;;\r\nmso-fareast-theme-font:minor-fareast;\r\nmso-hansi-font-family:Calibri;\r\nmso-hansi-theme-font:minor-latin;}\r\n&lt;/style&gt;\r\n&lt;![endif]--&gt;&lt;/p&gt;\r\n&lt;p&gt;Your friend ''{FRIEND_NAME}'' has sent you a link from {SITE_NAME} Please find the website link below to view this product.&lt;/p&gt;\r\n&lt;p&gt;Please click the following URL to checkout the website.:&lt;/p&gt;\r\n&lt;p&gt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;gt;&amp;gt;&amp;gt;&amp;gt;&amp;gt;&amp;gt;&amp;gt;&amp;gt;&amp;gt;&amp;gt;&amp;gt;&amp;gt;&amp;gt;&amp;gt;&amp;gt;&amp;gt;&amp;gt;&amp;gt;&amp;gt;&amp;gt;&amp;gt;&amp;gt;&amp;gt;&amp;gt;&amp;gt;&lt;/p&gt;\r\n&lt;p&gt;{PDETAIL_URL}&lt;/p&gt;\r\n&lt;p&gt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;lt;&amp;gt;&amp;gt;&amp;gt;&amp;gt;&amp;gt;&amp;gt;&amp;gt;&amp;gt;&amp;gt;&amp;gt;&amp;gt;&amp;gt;&amp;gt;&amp;gt;&amp;gt;&amp;gt;&amp;gt;&amp;gt;&amp;gt;&amp;gt;&amp;gt;&amp;gt;&amp;gt;&amp;gt;&amp;gt;&lt;/p&gt;\r\n&lt;p&gt;Note: If the above url is not clickable, please copy and paste this to your browser''s address bar .&lt;/p&gt;\r\n&lt;p&gt;Best Regards,&lt;/p&gt;\r\n&lt;p&gt;{SITE_NAME}&lt;/p&gt;', 'HTML');

-- --------------------------------------------------------

--
-- Table structure for table `gallery`
--

CREATE TABLE IF NOT EXISTS `gallery` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT '',
  `image` varchar(255) NOT NULL DEFAULT 'noimage.jpg',
  `caption` text CHARACTER SET utf8 NOT NULL,
  `description` text,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `position` int(255) NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '0',
  `show_home` tinyint(1) NOT NULL DEFAULT '0',
  `meta_name` varchar(255) NOT NULL,
  `urlname` varchar(255) DEFAULT NULL,
  `meta_keyword` text,
  `meta_description` longtext,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=23 ;

--
-- Dumping data for table `gallery`
--

INSERT INTO `gallery` (`id`, `name`, `image`, `caption`, `description`, `parent_id`, `position`, `is_active`, `show_home`, `meta_name`, `urlname`, `meta_keyword`, `meta_description`) VALUES
(19, 'Visits Gallery', 'Lighthouse.jpg', '', 'Here u can add imags for Visits  Gallery', 0, 0, 1, 0, 'Visits Gallery', 'Visits Gallery', 'Visits Gallery', 'Here u can add imags for Visits  Gallery'),
(22, 'Admin Gallery', 'pier518310.jpg', '', 'Description of admin gallery', 0, 0, 1, 0, 'Admin Gallery', 'admin-gallery', 'Admin Gallery', 'Admin Gallery');

-- --------------------------------------------------------

--
-- Table structure for table `gimage`
--

CREATE TABLE IF NOT EXISTS `gimage` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `image` varchar(255) NOT NULL DEFAULT 'noimage.jpg',
  `caption` text CHARACTER SET utf8 NOT NULL,
  `position` int(11) NOT NULL DEFAULT '0',
  `is_active` int(11) DEFAULT '1',
  `default_image` binary(1) NOT NULL DEFAULT '0',
  `link_url` varchar(255) DEFAULT NULL,
  `target` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=47 ;

--
-- Dumping data for table `gimage`
--

INSERT INTO `gimage` (`id`, `parent_id`, `image`, `caption`, `position`, `is_active`, `default_image`, `link_url`, `target`) VALUES
(46, 19, 'lotus60253345.jpg', '', 0, 1, '0', NULL, NULL),
(19, 20, 'Koala.jpg', 'koala', 1, 1, '0', NULL, NULL),
(18, 20, 'Tulips.jpg', 'Tulips', 2, 1, '0', NULL, NULL),
(45, 19, 'stones324900573.jpg', '', 0, 1, '0', NULL, NULL),
(24, 18, 'deqws.jpg', '', 2, 1, '0', NULL, NULL),
(23, 18, 'e.jpg', '', 2, 1, '0', NULL, NULL),
(42, 19, 'Penguins551926563.jpg', '', 1, 0, '0', NULL, NULL),
(43, 19, 'grass-blades595818007.jpg', '', 0, 1, '0', NULL, NULL),
(44, 19, 'mojave1210038512.jpg', '', 0, 1, '0', NULL, NULL),
(20, 20, 'Jellyfish.jpg', 'Jellyfish', 3, 1, '0', NULL, NULL),
(21, 20, 'Chrysanthemum.jpg', 'Chrysanthemum', 4, 1, '0', NULL, NULL),
(22, 20, 'big1821879351.jpg', 'Penguins', 5, 1, '0', NULL, NULL),
(25, 18, 'e1.jpg', '', 3, 1, '0', NULL, NULL),
(26, 18, 'gallery_image3.png', '', 4, 1, '0', NULL, NULL),
(27, 18, 'property_image.jpg', '', 5, 1, '0', NULL, NULL),
(39, 21, 'mojave1072464992.jpg', 'mojave', 3, 1, '0', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `keywords`
--

CREATE TABLE IF NOT EXISTS `keywords` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `page_name` varchar(255) NOT NULL,
  `page_title` varchar(255) NOT NULL,
  `keyword` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `keywords`
--

INSERT INTO `keywords` (`id`, `page_name`, `page_title`, `keyword`, `description`) VALUES
(2, 'gallery', 'Gallery', 'Gallery', '');

-- --------------------------------------------------------

--
-- Table structure for table `lists`
--

CREATE TABLE IF NOT EXISTS `lists` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `emailaddress` varchar(255) NOT NULL DEFAULT '',
  `signupon` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `ip_address` varchar(35) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `lists`
--

INSERT INTO `lists` (`id`, `name`, `emailaddress`, `signupon`, `ip_address`) VALUES
(16, 'test', 'test@test.com', '2009-11-19 16:44:23', '192.168.0.110');

-- --------------------------------------------------------

--
-- Table structure for table `module`
--

CREATE TABLE IF NOT EXISTS `module` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `page_name` varchar(255) NOT NULL,
  `display_name` varchar(255) NOT NULL,
  `is_active` enum('1','0') NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `module`
--

INSERT INTO `module` (`id`, `page_name`, `display_name`, `is_active`) VALUES
(1, 'news', 'News', '1'),
(2, 'event', 'Events', '1'),
(3, 'category', 'Business Directory', '1'),
(4, 'links', 'Links', '1'),
(5, 'council_videos', 'Videos', '1'),
(6, 'photos', 'Gallery', '1'),
(7, 'blog', 'Blog', '1'),
(8, 'faqs', 'F.A.Q', '1');

-- --------------------------------------------------------

--
-- Table structure for table `navigation`
--

CREATE TABLE IF NOT EXISTS `navigation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) DEFAULT '0',
  `navigation_title` varchar(255) DEFAULT NULL,
  `navigation_link` varchar(255) DEFAULT NULL,
  `small_description` varchar(256) CHARACTER SET utf8 DEFAULT NULL,
  `position` int(11) DEFAULT NULL,
  `is_active` int(11) DEFAULT NULL,
  `navigation_query` varchar(255) DEFAULT NULL,
  `page_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=ucs2 AUTO_INCREMENT=93 ;

--
-- Dumping data for table `navigation`
--

INSERT INTO `navigation` (`id`, `parent_id`, `navigation_title`, `navigation_link`, `small_description`, `position`, `is_active`, `navigation_query`, `page_id`) VALUES
(70, 0, 'About', 'about-us', '', 2, 1, '', NULL),
(58, 0, 'Home', 'home', 'Our Home', 3, 1, '', NULL),
(75, 58, 'Site Map', 'sitemap', NULL, 1, 1, NULL, NULL),
(78, 71, 'Hearth', 'hearth', NULL, 1, 1, NULL, NULL),
(71, 0, 'Products', 'hearth', '', 3, 1, '', NULL),
(72, 0, 'FAQ''s', 'faqs', '', 5, 1, '', NULL),
(77, 0, 'Contact Us', 'contact-us', NULL, 4, 1, NULL, NULL),
(79, 71, 'Plumbing', 'plumbing', NULL, 2, 1, NULL, NULL),
(80, 71, 'Outdoor', 'pools', NULL, 3, 1, NULL, NULL),
(81, 70, 'Projects', 'project', NULL, 1, 1, NULL, NULL),
(82, 58, 'News', 'content', NULL, 2, 1, 'id=31', 31),
(83, 70, 'Our Advice', 'advice', '', 1, 1, '', 32),
(84, 0, 'Resident', 'content', 'description', 0, 1, 'id=21', 20),
(85, 0, NULL, 'content', NULL, 0, 1, 'id=163', 163),
(89, 0, 'council-videoss', 'content', NULL, 0, 1, 'id=159', 159);

-- --------------------------------------------------------

--
-- Table structure for table `pimage`
--

CREATE TABLE IF NOT EXISTS `pimage` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `parent_id` int(255) NOT NULL DEFAULT '0',
  `image` varchar(2055) NOT NULL,
  `caption` text NOT NULL,
  `position` int(255) NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '0',
  `default_image` binary(1) NOT NULL DEFAULT '0',
  `link_url` varchar(255) DEFAULT NULL,
  `target` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `pimage`
--

INSERT INTO `pimage` (`id`, `parent_id`, `image`, `caption`, `position`, `is_active`, `default_image`, `link_url`, `target`) VALUES
(3, 3, 'img-3821879351.jpg', '', 1, 1, '0', NULL, NULL),
(4, 2, 'img-2224948290.jpg', '', 1, 1, '0', NULL, NULL),
(6, 1, 'img-11099438010.jpg', '', 1, 1, '0', NULL, NULL),
(7, 5, 'big3439990395.jpg', '', 1, 1, '0', NULL, NULL),
(8, 5, 'big41047755185.jpg', '', 2, 1, '0', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `project`
--

CREATE TABLE IF NOT EXISTS `project` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `image` varchar(2055) NOT NULL DEFAULT 'noimage.jpg',
  `caption` text NOT NULL,
  `description` text NOT NULL,
  `parent_id` int(255) NOT NULL DEFAULT '0',
  `position` int(255) NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `project`
--

INSERT INTO `project` (`id`, `name`, `image`, `caption`, `description`, `parent_id`, `position`, `is_active`) VALUES
(1, 'Project1', 'img-1607299.jpg', '', 'Project 1', 0, 0, 1),
(2, 'Project2', 'img-2.jpg', '', 'ASDasd', 0, 2, 1),
(3, 'Project3', 'img-3334808.jpg', '', 'project3', 0, 3, 1),
(5, 'Project4', 'hearth_pictures_1277985826.jpg', '', 'ade', 0, 4, 1),
(6, 'Project5', 'img-1572784.jpg', '', '', 0, 5, 1);

-- --------------------------------------------------------

--
-- Table structure for table `section`
--

CREATE TABLE IF NOT EXISTS `section` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `section_slug` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `section`
--

INSERT INTO `section` (`id`, `name`, `section_slug`) VALUES
(1, 'Visit', 'visit'),
(2, 'Relocate', 'relocate'),
(3, 'Residents', 'residents'),
(4, 'Business', 'business'),
(5, 'Content', 'content'),
(6, 'Conventions', 'conventions'),
(7, 'Living', 'living'),
(8, 'Age Friendly Project', 'age_friendly');

-- --------------------------------------------------------

--
-- Table structure for table `setting`
--

CREATE TABLE IF NOT EXISTS `setting` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `key` varchar(100) CHARACTER SET latin1 NOT NULL DEFAULT '',
  `value` varchar(100) CHARACTER SET latin1 NOT NULL DEFAULT '',
  `name` varchar(100) CHARACTER SET latin1 NOT NULL DEFAULT '',
  `title` varchar(255) DEFAULT NULL,
  `type` varchar(20) DEFAULT 'select',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=58 ;

--
-- Dumping data for table `setting`
--

INSERT INTO `setting` (`id`, `key`, `value`, `name`, `title`, `type`) VALUES
(1, 'ADMIN_EMAIL', 'rocky.developer001@gmail.com', 'email', 'admin email adress', 'text'),
(3, 'SUPPORT_EMAIL', 'rocky.developer004@gmail.com', 'email', 'support email address', 'text'),
(4, 'BCC_EMAIL', 'rocky.developer003@gmail.com', 'email', 'BCC email address', 'text'),
(6, 'SITE_NAME', 'pearlandpm', 'website', 'website name', 'text'),
(11, 'ADMIN_CATEGORY_PAGE_SIZE', '20', 'admin', 'page size for all pages', 'text'),
(28, 'THUMB_HEIGHT', '250', 'Image', 'Thumbnail height', 'text'),
(29, 'THUMB_WIDTH', '250', 'Image', 'Thumbnail width', 'text'),
(32, 'PHONE_NUMBER', '', 'address', 'Sales Phone Number', 'text'),
(34, 'ADDRESS1', '', 'address', 'Company Address Line 1', 'text'),
(35, 'ADDRESS2', '', 'address', 'Company Address Line 2', 'text'),
(36, 'CITY', '', 'address', 'City', 'text'),
(37, 'ZIP_CODE', '', 'address', 'Zip Code', 'text'),
(38, 'WEBSITE', '', 'address', 'Company Website', 'text'),
(39, 'SMTP_HOST', '', 'SMTP', 'SMTP Host', 'text'),
(40, 'SMTP_USERNAME', '', 'SMTP', 'SMTP Username', 'text'),
(41, 'SMTP_PASSWORD', '', 'SMTP', 'SMTP Password', 'text'),
(42, 'MEDIUM_HEIGHT', '350', 'Image', 'Medium Size Image height', 'text'),
(43, 'MEDIUM_WIDTH', '350', 'Image', 'Medium Size Image width', 'text'),
(44, 'FACEBOOK_PAGE', 'http://www.facebook.com/MarbleMountain', 'Social Media', 'Facebook Page ', 'text'),
(45, 'TWITTER_PAGE', 'http://twitter.com/#!/SkiMarble', 'Social Media', 'Twitter  Page ', 'text'),
(46, 'YOUTUBE_PAGE', 'http://www.youtube.com/SkiMarble', 'Social Media', 'Youtube Page', 'text'),
(47, 'GOOGLE_VC', '', 'SEO INFORMATION', 'Google Verify Code', 'text'),
(48, 'YAHOO_VC', '', 'SEO INFORMATION', 'Yahoo Verify Code', 'text'),
(49, 'BING_VC', '', 'SEO INFORMATION', 'Bing Verify Code', 'text'),
(50, 'GOOGLE_AC', '', 'SEO INFORMATION', 'Google Analytic Code', 'text'),
(51, 'APP_STORE', 'http://itunes.apple.com/ca/app/skimarble/id358173075?mt=8', 'Social Media', 'App Store', 'text'),
(52, 'WORDPRESS_BLOG', 'http://blog.skimarble.com/', 'Social Media', 'Wordpress Blog', 'text'),
(53, 'FDP', '1', 'Social Media', 'Facebook Direct Post', 'select'),
(54, 'TDP', '0', 'Social Media', 'Twitter  Direct Post', 'select'),
(55, 'FACEBOOK_APP_CODE', '299865633388242', 'Social Media', 'Facebook Application Code', 'text'),
(56, 'FACEBOOK_APP_SECRET', '98e820e7ab9a7063effd8f48febaffe6', 'Social Media', 'Facebook Application Secret', 'text'),
(57, 'HST', '14', 'Tax Rate', 'HST(%)', 'text');

-- --------------------------------------------------------

--
-- Table structure for table `slide`
--

CREATE TABLE IF NOT EXISTS `slide` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `slideshow_id` bigint(20) NOT NULL,
  `title` varchar(255) NOT NULL,
  `short_description` text NOT NULL,
  `image` varchar(2055) NOT NULL,
  `position` int(255) DEFAULT '0',
  `is_active` binary(1) NOT NULL DEFAULT '0',
  `link` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=31 ;

--
-- Dumping data for table `slide`
--

INSERT INTO `slide` (`id`, `slideshow_id`, `title`, `short_description`, `image`, `position`, `is_active`, `link`) VALUES
(18, 3, 'Slide1', 'description', '1967559.gif', 0, '1', ''),
(20, 4, 'Relocating? Grand Falls-Windsor is a prime location!', 'Relocating to Grand Falls-Windsor is made easy as you browse through our website. Grand Falls- Windsor welcomes you with open arms and has \r\nincluded plenty of information to answer all your questions about your new life here in our community. ', '', 1, '1', 'http://xtx.in/c5/gfw/?page=relocate&amp;'),
(21, 4, 'Residents', 'Your informational portal\r\n\r\nGrand Falls-Windsor is a very busy community. If you have questions about what''s going on in town, or about Council happenings, we have all that information here. We encourage your feedback on all Town issues. ', 'Penguins.jpg', 2, '1', ''),
(25, 4, 'Business', 'A prime location\r\n\r\nGrand Falls-Windsor is the economic center for the Province. With a strong base, we can address all your business needs', 'Desert.jpg', 3, '1', ''),
(28, 4, 'AS', 'as', 'flowing-rock.jpg', 0, '1', ''),
(29, 4, 'AS', 'DASDAS', 'stones972198.jpg', 0, '1', ''),
(30, 4, 'new testing slide', 'new testing slide', 'lightning.jpg', 0, '1', '');

-- --------------------------------------------------------

--
-- Table structure for table `slideshow`
--

CREATE TABLE IF NOT EXISTS `slideshow` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `slideshow_title` varchar(255) NOT NULL,
  `on_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `height` varchar(255) NOT NULL,
  `width` varchar(255) NOT NULL,
  `total` int(255) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `slideshow`
--

INSERT INTO `slideshow` (`id`, `slideshow_title`, `on_date`, `height`, `width`, `total`, `is_active`) VALUES
(4, 'Home Page Slides', '2011-07-27 10:31:32', '998', '997', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `web_stat`
--

CREATE TABLE IF NOT EXISTS `web_stat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(40) DEFAULT NULL,
  `on_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=608 ;

--
-- Dumping data for table `web_stat`
--

INSERT INTO `web_stat` (`id`, `ip_address`, `on_date`) VALUES
(1, '127.0.0.1', '2011-04-29 07:28:19'),
(2, '127.0.0.1', '2011-05-10 11:31:29'),
(3, '192.168.1.4', '2011-05-10 11:43:48'),
(4, '192.168.1.4', '2011-05-10 11:45:16'),
(5, '192.168.1.4', '2011-05-12 12:40:50'),
(6, '192.168.1.11', '2011-05-14 07:27:09'),
(7, '192.168.1.11', '2011-05-14 08:58:50'),
(8, '192.168.1.11', '2011-05-15 19:00:59'),
(9, '192.168.1.11', '2011-05-15 20:45:45'),
(10, '192.168.1.11', '2011-05-17 05:14:02'),
(11, '192.168.1.4', '2011-05-17 07:41:16'),
(12, '192.168.1.11', '2011-05-17 10:03:54'),
(13, '192.168.1.11', '2011-05-18 06:15:08'),
(14, '192.168.1.11', '2011-05-19 09:41:50'),
(15, '192.168.1.4', '2011-05-19 09:51:25'),
(16, '192.168.1.11', '2011-05-19 13:13:15'),
(17, '192.168.1.11', '2011-05-20 04:40:44'),
(18, '192.168.1.2', '2011-05-20 13:08:04'),
(19, '192.168.1.11', '2011-05-21 03:57:07'),
(20, '192.168.1.2', '2011-05-21 06:14:37'),
(21, '192.168.1.2', '2011-05-21 10:30:32'),
(22, '192.168.1.2', '2011-05-21 10:39:30'),
(23, '192.168.1.2', '2011-05-21 10:50:56'),
(24, '192.168.1.11', '2011-05-21 13:03:56'),
(25, '192.168.1.11', '2011-05-23 11:48:03'),
(26, '192.168.1.11', '2011-05-23 11:57:29'),
(27, '192.168.1.11', '2011-05-23 12:14:26'),
(28, '192.168.1.2', '2011-05-24 04:02:21'),
(29, '192.168.1.11', '2011-05-24 05:26:26'),
(30, '192.168.1.2', '2011-05-24 09:32:05'),
(31, '192.168.1.2', '2011-05-24 12:39:16'),
(32, '192.168.1.11', '2011-05-24 13:29:16'),
(33, '192.168.1.11', '2011-05-24 13:29:36'),
(34, '192.168.1.2', '2011-05-25 03:43:03'),
(35, '192.168.1.2', '2011-05-25 03:43:18'),
(36, '192.168.1.11', '2011-05-25 12:03:29'),
(37, '192.168.1.11', '2011-05-25 12:26:16'),
(38, '192.168.1.11', '2011-05-26 05:31:33'),
(39, '192.168.1.11', '2011-05-26 06:28:01'),
(40, '192.168.1.3', '2011-05-27 03:39:48'),
(41, '122.173.103.52', '2011-05-26 19:06:01'),
(42, '122.173.103.52', '2011-05-26 19:09:43'),
(43, '122.173.103.52', '2011-05-26 19:10:58'),
(44, '122.173.103.52', '2011-05-26 19:12:44'),
(45, '122.173.103.52', '2011-05-26 19:33:58'),
(46, '122.173.103.52', '2011-05-26 20:18:27'),
(47, '184.151.127.225', '2011-05-26 22:14:34'),
(48, '174.129.237.157', '2011-05-29 23:00:21'),
(49, '174.129.237.157', '2011-05-30 03:30:13'),
(50, '207.231.237.218', '2011-06-03 06:09:54'),
(51, '207.231.237.218', '2011-06-03 06:29:51'),
(52, '122.173.75.113', '2011-06-03 22:45:27'),
(53, '207.231.237.218', '2011-06-03 23:19:16'),
(54, '207.231.237.218', '2011-06-06 22:53:18'),
(55, '207.231.237.218', '2011-06-07 05:34:50'),
(56, '182.64.174.31', '2011-06-08 17:25:46'),
(57, '207.231.237.218', '2011-06-10 00:13:54'),
(58, '207.231.237.218', '2011-06-16 01:44:24'),
(59, '207.231.237.218', '2011-06-16 01:55:51'),
(60, '142.162.139.238', '2011-06-16 03:36:02'),
(61, '207.231.237.218', '2011-06-21 01:56:07'),
(62, '122.173.101.38', '2011-06-21 04:03:27'),
(63, '122.173.128.37', '2011-06-21 20:34:26'),
(64, '207.231.237.102', '2011-06-21 23:46:02'),
(65, '122.173.129.220', '2011-06-23 19:06:41'),
(66, '207.231.237.218', '2011-06-23 22:31:17'),
(67, '122.173.129.220', '2011-06-23 22:41:15'),
(68, '142.162.128.57', '2011-06-24 00:55:04'),
(69, '207.231.237.218', '2011-06-24 03:17:03'),
(70, '122.173.42.213', '2011-06-24 03:56:02'),
(71, '207.231.237.218', '2011-06-27 23:14:00'),
(72, '122.173.19.104', '2011-06-28 07:52:41'),
(73, '207.231.237.102', '2011-06-29 03:22:28'),
(74, '207.231.237.218', '2011-06-30 00:14:30'),
(75, '174.129.237.157', '2011-06-30 01:00:45'),
(76, '207.231.237.218', '2011-07-01 00:09:05'),
(77, '207.231.237.218', '2011-07-01 00:52:48'),
(78, '182.64.145.178', '2011-07-01 19:20:50'),
(79, '127.0.0.1', '2011-07-10 12:51:24'),
(80, '127.0.0.1', '2011-07-13 04:43:01'),
(81, '192.168.1.4', '2011-07-13 04:47:29'),
(82, '127.0.0.1', '2011-07-13 09:07:01'),
(83, '192.168.1.4', '2011-07-13 09:30:19'),
(84, '127.0.0.1', '2011-07-14 03:24:36'),
(85, '127.0.0.1', '2011-07-14 03:25:08'),
(86, '192.168.1.4', '2011-07-14 03:26:40'),
(87, '127.0.0.1', '2011-07-15 03:37:32'),
(88, '192.168.1.2', '2011-07-15 03:37:52'),
(89, '192.168.1.2', '2011-07-15 04:09:13'),
(90, '127.0.0.1', '2011-07-16 03:50:37'),
(91, '192.168.1.3', '2011-07-16 03:51:10'),
(92, '127.0.0.1', '2011-07-16 04:53:13'),
(93, '192.168.1.3', '2011-07-16 04:53:24'),
(94, '192.168.1.8', '2011-07-16 05:24:13'),
(95, '192.168.1.6', '2011-07-19 03:50:37'),
(96, '192.168.1.6', '2011-07-19 04:41:17'),
(97, '192.168.1.6', '2011-07-19 05:01:06'),
(98, '192.168.1.6', '2011-07-19 05:07:56'),
(99, '192.168.1.6', '2011-07-19 05:17:01'),
(100, '192.168.1.6', '2011-07-19 05:21:14'),
(101, '192.168.1.8', '2011-07-19 05:42:18'),
(102, '127.0.0.1', '2011-07-19 05:54:42'),
(103, '192.168.1.6', '2011-07-19 05:54:47'),
(104, '127.0.0.1', '2011-07-19 06:26:28'),
(105, '192.168.1.6', '2011-07-19 06:27:11'),
(106, '192.168.1.8', '2011-07-19 07:50:28'),
(107, '192.168.1.8', '2011-07-19 07:56:28'),
(108, '192.168.1.6', '2011-07-19 08:33:16'),
(109, '127.0.0.1', '2011-07-19 08:54:32'),
(110, '192.168.1.6', '2011-07-19 08:54:49'),
(111, '192.168.1.6', '2011-07-19 09:01:14'),
(112, '127.0.0.1', '2011-07-19 11:39:32'),
(113, '192.168.1.6', '2011-07-19 11:40:13'),
(114, '192.168.1.6', '2011-07-19 11:42:10'),
(115, '127.0.0.1', '2011-07-19 11:46:56'),
(116, '127.0.0.1', '2011-07-19 11:51:35'),
(117, '192.168.1.6', '2011-07-19 11:52:20'),
(118, '192.168.1.2', '2011-07-19 12:06:22'),
(119, '192.168.1.2', '2011-07-19 12:06:42'),
(120, '192.168.1.5', '2011-07-19 12:12:29'),
(121, '127.0.0.1', '2011-07-19 12:13:22'),
(122, '127.0.0.1', '2011-07-19 12:28:33'),
(123, '192.168.1.5', '2011-07-19 12:34:09'),
(124, '192.168.1.6', '2011-07-19 12:35:07'),
(125, '192.168.1.6', '2011-07-19 12:37:57'),
(126, '127.0.0.1', '2011-07-19 12:42:20'),
(127, '192.168.1.8', '2011-07-19 12:44:29'),
(128, '192.168.1.6', '2011-07-19 13:30:53'),
(129, '192.168.1.6', '2011-07-19 13:30:53'),
(130, '127.0.0.1', '2011-07-20 03:44:23'),
(131, '192.168.1.6', '2011-07-20 03:44:38'),
(132, '127.0.0.1', '2011-07-20 03:45:45'),
(133, '192.168.1.6', '2011-07-20 03:59:00'),
(134, '192.168.1.5', '2011-07-20 05:34:47'),
(135, '192.168.1.6', '2011-07-20 05:55:22'),
(136, '192.168.1.8', '2011-07-20 06:28:16'),
(137, '127.0.0.1', '2011-07-20 09:29:12'),
(138, '127.0.0.1', '2011-07-21 03:58:00'),
(139, '127.0.0.1', '2011-07-21 11:17:33'),
(140, '192.168.1.6', '2011-07-21 11:28:50'),
(141, '192.168.1.8', '2011-07-21 11:38:42'),
(142, '192.168.1.6', '2011-07-22 09:52:57'),
(143, '127.0.0.1', '2011-07-23 03:39:56'),
(144, '192.168.1.6', '2011-07-23 03:40:11'),
(145, '192.168.1.8', '2011-07-23 05:07:17'),
(146, '127.0.0.1', '2011-07-26 03:49:37'),
(147, '192.168.1.6', '2011-07-26 03:49:47'),
(148, '127.0.0.1', '2011-07-27 05:32:52'),
(149, '127.0.0.1', '2011-07-27 08:11:10'),
(150, '192.168.1.6', '2011-07-27 10:50:03'),
(151, '127.0.0.1', '2011-07-28 03:52:40'),
(152, '192.168.1.6', '2011-07-28 03:54:13'),
(153, '192.168.1.6', '2011-07-28 04:50:35'),
(154, '192.168.1.7', '2011-07-28 05:17:20'),
(155, '192.168.1.6', '2011-07-28 10:22:45'),
(156, '192.168.1.7', '2011-07-28 10:24:09'),
(157, '192.168.1.6', '2011-07-28 10:29:19'),
(158, '192.168.1.3', '2011-07-28 10:40:05'),
(159, '192.168.1.2', '2011-07-28 10:43:53'),
(160, '192.168.1.6', '2011-07-28 10:48:50'),
(161, '192.168.1.6', '2011-07-28 10:48:57'),
(162, '192.168.1.3', '2011-07-28 11:40:16'),
(163, '127.0.0.1', '2011-08-23 11:31:34'),
(164, '127.0.0.1', '2011-08-24 04:08:02'),
(165, '127.0.0.1', '2011-08-24 04:09:52'),
(166, '192.168.1.7', '2011-08-24 04:51:22'),
(167, '192.168.1.7', '2011-08-24 05:22:51'),
(168, '192.168.1.7', '2011-08-24 05:26:37'),
(169, '192.168.1.7', '2011-08-24 08:55:31'),
(170, '192.168.1.7', '2011-08-24 11:52:14'),
(171, '192.168.1.7', '2011-08-24 11:54:01'),
(172, '127.0.0.1', '2011-08-25 03:55:51'),
(173, '192.168.1.7', '2011-08-25 03:56:04'),
(174, '192.168.1.9', '2011-08-25 07:50:01'),
(175, '192.168.1.7', '2011-08-25 10:13:36'),
(176, '192.168.1.7', '2011-08-25 10:25:32'),
(177, '192.168.1.9', '2011-08-25 13:18:14'),
(178, '127.0.0.1', '2011-08-26 03:47:51'),
(179, '192.168.1.7', '2011-08-26 03:48:14'),
(180, '127.0.0.1', '2011-08-26 08:56:39'),
(181, '192.168.1.7', '2011-08-26 08:57:08'),
(182, '192.168.1.9', '2011-08-26 09:07:43'),
(183, '192.168.1.6', '2011-08-26 09:30:39'),
(184, '192.168.1.7', '2011-08-26 09:33:54'),
(185, '192.168.1.9', '2011-08-26 11:23:19'),
(186, '192.168.1.9', '2011-08-26 12:23:43'),
(187, '192.168.1.7', '2011-08-26 12:41:48'),
(188, '192.168.1.6', '2011-08-26 13:13:27'),
(189, '127.0.0.1', '2011-08-27 03:43:16'),
(190, '192.168.1.7', '2011-08-27 03:43:29'),
(191, '192.168.1.6', '2011-08-27 11:52:25'),
(192, '127.0.0.1', '2011-08-30 03:59:18'),
(193, '192.168.1.7', '2011-08-30 03:59:23'),
(194, '192.168.1.7', '2011-08-30 04:07:36'),
(195, '192.168.1.2', '2011-08-30 05:42:51'),
(196, '192.168.1.7', '2011-08-30 05:56:52'),
(197, '192.168.1.9', '2011-08-30 07:05:41'),
(198, '192.168.1.7', '2011-08-30 09:41:45'),
(199, '192.168.1.4', '2011-08-30 09:47:52'),
(200, '127.0.0.1', '2011-08-30 10:39:26'),
(201, '192.168.1.7', '2011-08-30 10:39:33'),
(202, '192.168.1.7', '2011-08-30 12:47:01'),
(203, '127.0.0.1', '2011-08-30 12:52:40'),
(204, '192.168.1.7', '2011-08-30 12:52:57'),
(205, '127.0.0.1', '2011-08-30 13:05:45'),
(206, '192.168.1.7', '2011-08-30 13:15:47'),
(207, '127.0.0.1', '2011-08-31 04:11:17'),
(208, '192.168.1.7', '2011-08-31 04:17:39'),
(209, '127.0.0.1', '2011-08-31 04:37:36'),
(210, '192.168.1.7', '2011-08-31 04:37:51'),
(211, '192.168.1.7', '2011-08-31 06:20:31'),
(212, '127.0.0.1', '2011-08-31 06:37:45'),
(213, '192.168.1.7', '2011-08-31 06:39:50'),
(214, '127.0.0.1', '2011-09-09 06:03:28'),
(215, '192.168.1.3', '2011-09-09 06:48:19'),
(216, '127.0.0.1', '2011-09-09 06:53:49'),
(217, '192.168.1.3', '2011-09-09 07:42:19'),
(218, '192.168.1.3', '2011-09-09 09:57:46'),
(219, '127.0.0.1', '2011-09-10 03:52:49'),
(220, '192.168.1.3', '2011-09-10 04:07:28'),
(221, '192.168.1.3', '2011-09-10 04:39:47'),
(222, '127.0.0.1', '2011-09-10 05:25:47'),
(223, '192.168.1.3', '2011-09-10 05:38:35'),
(224, '127.0.0.1', '2011-09-10 07:16:24'),
(225, '127.0.0.1', '2011-09-10 07:46:59'),
(226, '192.168.1.3', '2011-09-10 07:47:08'),
(227, '127.0.0.1', '2011-09-10 09:42:45'),
(228, '192.168.1.3', '2011-09-10 09:42:58'),
(229, '127.0.0.1', '2011-09-10 09:49:23'),
(230, '192.168.1.3', '2011-09-10 09:49:38'),
(231, '192.168.1.6', '2011-09-10 10:29:53'),
(232, '127.0.0.1', '2011-09-13 03:56:09'),
(233, '127.0.0.1', '2011-09-13 03:56:28'),
(234, '192.168.1.4', '2011-09-13 04:44:57'),
(235, '127.0.0.1', '2011-09-13 07:16:38'),
(236, '192.168.1.3', '2011-09-13 12:10:42'),
(237, '127.0.0.1', '2011-09-13 12:48:27'),
(238, '192.168.1.10', '2011-09-13 12:48:42'),
(239, '127.0.0.1', '2011-09-14 03:45:23'),
(240, '192.168.1.4', '2011-09-14 03:46:52'),
(241, '127.0.0.1', '2011-09-14 04:21:52'),
(242, '127.0.0.1', '2011-09-14 05:43:21'),
(243, '127.0.0.1', '2011-09-15 03:50:30'),
(244, '192.168.1.4', '2011-09-15 03:51:13'),
(245, '127.0.0.1', '2011-09-15 04:10:57'),
(246, '192.168.1.4', '2011-09-15 04:11:14'),
(247, '127.0.0.1', '2011-09-15 05:44:13'),
(248, '192.168.1.9', '2011-09-15 06:48:54'),
(249, '192.168.1.7', '2011-09-15 12:39:41'),
(250, '192.168.1.7', '2011-09-15 12:39:41'),
(251, '127.0.0.1', '2011-09-15 14:05:01'),
(252, '127.0.0.1', '2011-09-16 05:09:50'),
(253, '192.168.1.7', '2011-09-16 05:33:38'),
(254, '192.168.1.7', '2011-09-16 05:34:42'),
(255, '192.168.1.7', '2011-09-16 05:35:07'),
(256, '192.168.1.5', '2011-09-16 06:19:26'),
(257, '192.168.1.8', '2011-09-16 06:39:22'),
(258, '192.168.1.5', '2011-09-16 07:51:14'),
(259, '192.168.1.8', '2011-09-16 08:17:14'),
(260, '127.0.0.1', '2011-09-16 09:08:09'),
(261, '192.168.1.7', '2011-09-16 09:08:13'),
(262, '192.168.1.5', '2011-09-16 09:37:29'),
(263, '192.168.1.7', '2011-09-16 10:10:13'),
(264, '127.0.0.1', '2011-09-16 10:15:07'),
(265, '192.168.1.7', '2011-09-16 10:15:14'),
(266, '192.168.1.3', '2011-09-16 10:16:32'),
(267, '127.0.0.1', '2011-09-17 04:08:35'),
(268, '192.168.1.4', '2011-09-17 04:10:36'),
(269, '192.168.1.4', '2011-09-17 04:15:32'),
(270, '127.0.0.1', '2011-09-20 03:45:54'),
(271, '192.168.1.3', '2011-09-20 03:46:18'),
(272, '192.168.1.9', '2011-09-20 06:04:25'),
(273, '127.0.0.1', '2011-09-20 07:43:17'),
(274, '192.168.1.9', '2011-09-20 09:52:23'),
(275, '192.168.1.4', '2011-10-01 12:21:30'),
(276, '127.0.0.1', '2011-11-10 10:59:14'),
(277, '192.168.1.5', '2011-11-11 07:50:21'),
(278, '192.168.1.5', '2011-11-11 08:24:05'),
(279, '192.168.1.39', '2011-11-11 08:41:35'),
(280, '192.168.1.3', '2011-11-11 10:22:42'),
(281, '192.168.1.45', '2011-11-11 11:59:58'),
(282, '127.0.0.1', '2011-11-12 05:49:15'),
(283, '192.168.1.5', '2011-11-12 05:50:59'),
(284, '192.168.1.5', '2011-11-12 08:56:07'),
(285, '127.0.0.1', '2011-11-12 13:02:12'),
(286, '192.168.1.45', '2011-11-12 15:12:16'),
(287, '127.0.0.1', '2011-11-15 05:38:05'),
(288, '192.168.1.5', '2011-11-15 06:00:43'),
(289, '192.168.1.5', '2011-11-15 13:21:11'),
(290, '127.0.0.1', '2011-11-16 05:48:59'),
(291, '192.168.1.5', '2011-11-16 05:50:53'),
(292, '127.0.0.1', '2011-11-16 07:36:59'),
(293, '192.168.1.5', '2011-11-16 07:37:04'),
(294, '192.168.1.45', '2011-11-16 09:35:44'),
(295, '192.168.1.5', '2011-11-16 09:48:32'),
(296, '192.168.1.45', '2011-11-16 15:40:28'),
(297, '127.0.0.1', '2011-11-17 05:42:16'),
(298, '192.168.1.5', '2011-11-17 05:55:18'),
(299, '192.168.1.5', '2011-11-17 09:40:55'),
(300, '192.168.1.5', '2011-11-17 11:33:48'),
(301, '192.168.1.5', '2011-11-17 14:35:41'),
(302, '192.168.1.45', '2011-11-17 15:26:45'),
(303, '127.0.0.1', '2011-11-18 05:43:38'),
(304, '192.168.1.5', '2011-11-18 05:44:11'),
(305, '192.168.1.5', '2011-11-18 05:55:44'),
(306, '192.168.1.3', '2011-11-18 06:56:03'),
(307, '192.168.1.5', '2011-11-18 07:05:20'),
(308, '192.168.1.5', '2011-11-18 07:05:20'),
(309, '192.168.1.5', '2011-11-18 07:05:22'),
(310, '192.168.1.5', '2011-11-18 12:23:12'),
(311, '127.0.0.1', '2011-11-18 12:47:49'),
(312, '192.168.1.5', '2011-11-18 12:53:05'),
(313, '192.168.1.45', '2011-11-18 16:55:21'),
(314, '127.0.0.1', '2011-11-19 05:55:04'),
(315, '192.168.1.5', '2011-11-19 05:55:16'),
(316, '192.168.1.5', '2011-11-19 06:51:06'),
(317, '192.168.1.5', '2011-11-19 13:36:55'),
(318, '192.168.1.5', '2011-11-19 13:59:58'),
(319, '122.176.82.67', '2011-11-21 17:15:23'),
(320, '210.56.109.123', '2011-11-21 21:52:00'),
(321, '122.176.82.67', '2011-11-21 22:55:32'),
(322, '207.231.237.218', '2011-11-21 23:56:08'),
(323, '122.176.82.67', '2011-11-22 01:13:26'),
(324, '173.32.193.180', '2011-11-22 03:18:33'),
(325, '173.32.193.180', '2011-11-22 06:09:58'),
(326, '173.32.193.180', '2011-11-29 10:37:23'),
(327, '122.173.39.45', '2011-11-29 10:45:58'),
(328, '184.151.115.46', '2011-11-29 13:12:14'),
(329, '184.151.115.46', '2011-11-29 13:16:47'),
(330, '210.56.108.68', '2011-11-29 20:26:41'),
(331, '210.56.108.68', '2011-11-29 21:05:42'),
(332, '142.163.214.174', '2011-11-30 00:29:45'),
(333, '142.162.0.61', '2011-11-30 00:57:33'),
(334, '142.163.214.174', '2011-11-30 02:24:27'),
(335, '142.162.0.61', '2011-11-30 02:38:10'),
(336, '142.163.214.174', '2011-11-30 05:04:31'),
(337, '142.162.0.98', '2011-11-30 06:32:21'),
(338, '122.176.82.67', '2011-11-30 17:08:14'),
(339, '142.162.1.23', '2011-12-01 02:44:01'),
(340, '122.176.82.67', '2011-12-01 17:08:46'),
(341, '124.253.3.133', '2011-12-02 03:05:44'),
(342, '122.173.110.189', '2011-12-02 15:56:40'),
(343, '122.176.82.67', '2011-12-02 17:12:03'),
(344, '122.176.82.67', '2011-12-03 01:44:27'),
(345, '210.56.113.110', '2011-12-03 02:07:30'),
(346, '210.56.113.110', '2011-12-03 03:24:35'),
(347, '210.56.113.110', '2011-12-03 03:46:20'),
(348, '223.178.20.250', '2011-12-03 16:21:17'),
(349, '210.56.111.223', '2011-12-03 17:07:34'),
(350, '210.56.111.223', '2011-12-03 17:21:30'),
(351, '210.56.111.223', '2011-12-03 18:16:15'),
(352, '122.173.138.161', '2011-12-05 01:30:43'),
(353, '210.56.96.233', '2011-12-05 17:11:49'),
(354, '210.56.107.25', '2011-12-06 00:40:00'),
(355, '142.163.214.174', '2011-12-06 03:03:56'),
(356, '122.173.139.156', '2011-12-06 05:05:09'),
(357, '74.125.112.82', '2011-12-06 05:06:12'),
(358, '74.125.114.80', '2011-12-06 05:31:33'),
(359, '173.32.193.180', '2011-12-06 05:33:43'),
(360, '173.32.193.180', '2011-12-06 05:45:03'),
(361, '142.163.214.174', '2011-12-06 06:01:25'),
(362, '173.32.193.180', '2011-12-06 07:42:27'),
(363, '210.56.108.106', '2011-12-06 17:09:13'),
(364, '210.56.108.106', '2011-12-06 18:24:03'),
(365, '210.56.108.106', '2011-12-06 18:25:14'),
(366, '122.176.82.67', '2011-12-06 18:53:52'),
(367, '122.176.82.67', '2011-12-06 19:32:21'),
(368, '210.56.108.106', '2011-12-06 21:02:29'),
(369, '122.176.82.67', '2011-12-06 22:19:24'),
(370, '210.56.108.106', '2011-12-06 22:22:38'),
(371, '210.56.108.106', '2011-12-06 22:23:19'),
(372, '210.56.108.106', '2011-12-06 22:37:37'),
(373, '122.176.82.67', '2011-12-06 23:37:51'),
(374, '124.253.70.176', '2011-12-06 23:38:35'),
(375, '124.253.70.176', '2011-12-06 23:45:43'),
(376, '142.162.0.93', '2011-12-07 00:57:59'),
(377, '122.176.82.67', '2011-12-07 01:27:47'),
(378, '124.253.70.176', '2011-12-07 04:12:17'),
(379, '122.173.154.21', '2011-12-07 07:01:08'),
(380, '142.162.0.93', '2011-12-07 08:22:55'),
(381, '184.151.115.127', '2011-12-07 08:34:56'),
(382, '122.176.82.67', '2011-12-07 16:56:50'),
(383, '210.56.107.184', '2011-12-07 17:18:10'),
(384, '142.163.214.174', '2011-12-08 00:36:27'),
(385, '142.163.214.174', '2011-12-08 01:05:30'),
(386, '122.176.82.67', '2011-12-08 02:57:13'),
(387, '207.231.237.218', '2011-12-09 01:35:31'),
(388, '122.176.82.67', '2011-12-09 02:05:00'),
(389, '124.253.69.96', '2011-12-09 02:10:18'),
(390, '142.163.214.174', '2011-12-09 06:44:29'),
(391, '124.253.6.156', '2011-12-09 17:16:52'),
(392, '124.253.69.24', '2011-12-09 23:02:10'),
(393, '122.176.82.67', '2011-12-09 23:47:59'),
(394, '122.176.82.67', '2011-12-10 00:30:16'),
(395, '122.176.82.67', '2011-12-10 01:00:21'),
(396, '122.176.82.67', '2011-12-10 01:00:21'),
(397, '122.176.82.67', '2011-12-10 02:24:44'),
(398, '124.253.69.24', '2011-12-10 02:34:50'),
(399, '184.151.127.181', '2011-12-10 09:20:17'),
(400, '122.176.82.67', '2011-12-10 17:28:05'),
(401, '122.173.86.175', '2011-12-11 07:18:37'),
(402, '192.168.1.5', '2011-12-13 17:31:32'),
(403, '192.168.1.5', '2011-12-13 19:21:52'),
(404, '192.168.1.5', '2011-12-13 19:22:11'),
(405, '127.0.0.1', '2011-12-13 23:32:04'),
(406, '192.168.1.5', '2011-12-13 23:48:01'),
(407, '192.168.1.5', '2011-12-14 00:04:39'),
(408, '192.168.1.5', '2011-12-14 00:24:18'),
(409, '210.56.105.208', '2011-12-13 13:00:05'),
(410, '210.56.105.208', '2011-12-13 13:07:21'),
(411, '210.56.105.208', '2011-12-13 13:37:31'),
(412, '142.163.214.174', '2011-12-13 13:41:09'),
(413, '142.163.214.174', '2011-12-13 13:48:10'),
(414, '210.56.105.208', '2011-12-13 14:23:05'),
(415, '210.56.105.208', '2011-12-13 15:13:34'),
(416, '124.253.11.112', '2011-12-14 04:51:41'),
(417, '124.253.11.112', '2011-12-14 07:46:20'),
(418, '122.176.82.67', '2011-12-14 14:07:10'),
(419, '122.176.82.67', '2011-12-14 14:10:34'),
(420, '210.56.109.254', '2011-12-15 05:11:18'),
(421, '210.56.109.254', '2011-12-15 07:17:40'),
(422, '210.56.109.254', '2011-12-15 07:17:44'),
(423, '122.176.82.67', '2011-12-15 08:22:55'),
(424, '210.56.109.254', '2011-12-15 08:28:46'),
(425, '122.176.82.67', '2011-12-15 11:21:33'),
(426, '142.162.1.153', '2011-12-15 17:53:33'),
(427, '122.173.143.240', '2011-12-15 18:48:01'),
(428, '122.173.143.240', '2011-12-15 19:04:13'),
(429, '142.163.214.174', '2011-12-15 19:50:02'),
(430, '210.56.103.188', '2011-12-16 04:45:07'),
(431, '122.176.82.67', '2011-12-16 06:20:09'),
(432, '210.56.103.188', '2011-12-16 06:28:02'),
(433, '122.176.82.67', '2011-12-16 09:10:23'),
(434, '210.56.103.188', '2011-12-16 09:11:56'),
(435, '210.56.103.188', '2011-12-16 09:18:18'),
(436, '122.176.82.67', '2011-12-16 11:15:40'),
(437, '122.176.82.67', '2011-12-19 05:03:55'),
(438, '124.253.0.12', '2011-12-19 08:55:29'),
(439, '142.163.214.174', '2011-12-19 12:02:09'),
(440, '142.162.0.92', '2011-12-19 12:07:47'),
(441, '122.176.82.67', '2011-12-19 13:55:54'),
(442, '124.253.0.12', '2011-12-19 14:27:04'),
(443, '142.163.75.231', '2011-12-19 15:23:15'),
(444, '173.32.193.180', '2011-12-19 16:08:19'),
(445, '115.244.95.126', '2011-12-19 17:10:04'),
(446, '173.32.193.180', '2011-12-19 18:47:27'),
(447, '142.163.75.231', '2011-12-19 18:47:39'),
(448, '207.231.237.218', '2011-12-19 18:56:49'),
(449, '207.231.237.218', '2011-12-19 19:35:16'),
(450, '122.176.82.67', '2011-12-20 04:46:29'),
(451, '124.253.1.116', '2011-12-20 06:00:51'),
(452, '122.176.82.67', '2011-12-20 07:49:32'),
(453, '122.176.82.67', '2011-12-20 10:21:35'),
(454, '122.176.82.67', '2011-12-20 11:22:29'),
(455, '142.163.67.126', '2011-12-20 12:02:16'),
(456, '173.32.193.180', '2011-12-20 12:29:03'),
(457, '207.231.237.218', '2011-12-20 13:11:24'),
(458, '173.32.193.180', '2011-12-20 13:12:51'),
(459, '124.253.1.116', '2011-12-20 13:22:41'),
(460, '124.253.1.116', '2011-12-20 13:25:09'),
(461, '124.253.1.116', '2011-12-20 14:30:28'),
(462, '173.32.193.180', '2011-12-20 14:46:14'),
(463, '207.231.237.218', '2011-12-20 16:47:46'),
(464, '122.173.20.214', '2011-12-20 16:52:54'),
(465, '142.163.67.126', '2011-12-20 17:33:37'),
(466, '142.163.67.126', '2011-12-20 18:00:39'),
(467, '124.253.6.124', '2011-12-21 04:53:46'),
(468, '124.253.6.124', '2011-12-21 04:56:27'),
(469, '124.253.6.124', '2011-12-21 06:15:15'),
(470, '192.168.1.3', '2011-12-21 12:02:06'),
(471, '192.168.1.3', '2011-12-21 12:17:51'),
(472, '192.168.1.3', '2011-12-21 12:17:53'),
(473, '192.168.1.4', '2011-12-21 14:06:53'),
(474, '127.0.0.1', '2011-12-22 05:17:08'),
(475, '192.168.1.5', '2011-12-22 05:17:10'),
(476, '192.168.1.5', '2011-12-22 05:17:10'),
(477, '127.0.0.1', '2011-12-23 04:59:10'),
(478, '192.168.1.5', '2011-12-23 04:59:12'),
(479, '192.168.1.5', '2011-12-23 04:59:12'),
(480, '192.168.1.5', '2011-12-23 07:35:53'),
(481, '127.0.0.1', '2011-12-23 08:05:15'),
(482, '127.0.0.1', '2011-12-31 10:48:03'),
(483, '192.168.1.5', '2011-12-31 10:48:06'),
(484, '192.168.1.5', '2011-12-31 10:48:06'),
(485, '127.0.0.1', '2011-12-31 12:19:49'),
(486, '192.168.1.5', '2011-12-31 12:19:51'),
(487, '192.168.1.5', '2011-12-31 12:19:51'),
(488, '192.168.1.5', '2011-12-31 12:19:52'),
(489, '192.168.1.39', '2012-01-04 08:04:20'),
(490, '192.168.1.39', '2012-01-05 05:24:23'),
(491, '192.168.1.39', '2012-01-10 09:19:13'),
(492, '192.168.1.5', '2012-01-19 11:44:18'),
(493, '127.0.0.1', '2012-01-19 12:55:41'),
(494, '192.168.1.5', '2012-01-19 12:55:43'),
(495, '192.168.1.5', '2012-01-19 12:55:44'),
(496, '192.168.1.5', '2012-01-19 12:55:44'),
(497, '127.0.0.1', '2012-01-20 04:51:57'),
(498, '192.168.1.5', '2012-01-20 04:51:58'),
(499, '192.168.1.5', '2012-01-20 04:51:58'),
(500, '192.168.1.5', '2012-01-23 11:09:43'),
(501, '192.168.1.4', '2012-01-23 14:31:23'),
(502, '127.0.0.1', '2012-01-24 06:39:20'),
(503, '192.168.1.5', '2012-01-24 06:39:20'),
(504, '192.168.1.5', '2012-01-24 06:39:20'),
(505, '192.168.1.5', '2012-01-24 06:39:20'),
(506, '192.168.1.5', '2012-01-24 06:39:20'),
(507, '192.168.1.5', '2012-01-24 06:39:20'),
(508, '192.168.1.5', '2012-01-24 06:39:20'),
(509, '192.168.1.5', '2012-01-24 06:39:21'),
(510, '192.168.1.5', '2012-01-24 06:39:21'),
(511, '192.168.1.5', '2012-01-24 07:06:41'),
(512, '192.168.1.5', '2012-01-24 07:13:17'),
(513, '192.168.1.5', '2012-01-24 07:57:47'),
(514, '192.168.1.5', '2012-01-24 11:24:19'),
(515, '192.168.1.45', '2012-01-24 14:23:41'),
(516, '127.0.0.1', '2012-01-25 04:48:21'),
(517, '127.0.0.1', '2012-01-25 05:01:35'),
(518, '192.168.1.5', '2012-01-25 05:01:37'),
(519, '192.168.1.5', '2012-01-25 05:01:37'),
(520, '192.168.1.5', '2012-01-25 05:01:38'),
(521, '192.168.1.5', '2012-01-25 05:01:38'),
(522, '192.168.1.5', '2012-01-25 05:01:38'),
(523, '192.168.1.5', '2012-01-25 05:01:38'),
(524, '192.168.1.5', '2012-01-25 05:01:38'),
(525, '192.168.1.5', '2012-01-25 05:01:38'),
(526, '192.168.1.5', '2012-01-25 05:01:38'),
(527, '192.168.1.5', '2012-01-25 05:01:38'),
(528, '192.168.1.5', '2012-01-25 05:01:38'),
(529, '192.168.1.5', '2012-01-25 06:54:50'),
(530, '192.168.1.5', '2012-01-25 12:02:54'),
(531, '192.168.1.45', '2012-01-25 14:50:37'),
(532, '127.0.0.1', '2012-02-01 06:14:37'),
(533, '192.168.1.5', '2012-02-01 06:14:39'),
(534, '192.168.1.5', '2012-02-01 06:14:39'),
(535, '192.168.1.5', '2012-02-01 06:14:39'),
(536, '192.168.1.5', '2012-02-01 06:14:39'),
(537, '192.168.1.5', '2012-02-01 06:14:39'),
(538, '192.168.1.5', '2012-02-01 06:14:39'),
(539, '192.168.1.5', '2012-02-01 06:14:39'),
(540, '192.168.1.5', '2012-02-01 06:14:39'),
(541, '192.168.1.5', '2012-02-01 06:39:40'),
(542, '192.168.1.45', '2012-02-01 12:50:29'),
(543, '127.0.0.1', '2012-02-01 13:34:04'),
(544, '192.168.1.5', '2012-02-01 13:34:05'),
(545, '192.168.1.5', '2012-02-01 13:34:05'),
(546, '192.168.1.5', '2012-02-01 13:34:05'),
(547, '192.168.1.5', '2012-02-01 13:34:05'),
(548, '192.168.1.5', '2012-02-01 13:34:05'),
(549, '192.168.1.5', '2012-02-01 13:34:05'),
(550, '192.168.1.5', '2012-02-01 13:34:05'),
(551, '192.168.1.5', '2012-02-01 13:34:05'),
(552, '192.168.1.5', '2012-02-01 13:55:25'),
(553, '127.0.0.1', '2012-02-02 04:47:40'),
(554, '192.168.1.5', '2012-02-02 04:47:41'),
(555, '192.168.1.5', '2012-02-02 04:47:41'),
(556, '192.168.1.5', '2012-02-02 04:47:41'),
(557, '192.168.1.5', '2012-02-02 04:47:41'),
(558, '192.168.1.5', '2012-02-02 04:47:41'),
(559, '192.168.1.5', '2012-02-02 04:47:41'),
(560, '192.168.1.5', '2012-02-02 04:47:41'),
(561, '192.168.1.5', '2012-02-02 04:47:41'),
(562, '192.168.1.45', '2012-02-02 06:55:35'),
(563, '192.168.1.5', '2012-02-02 07:24:42'),
(564, '192.168.1.45', '2012-02-02 14:11:53'),
(565, '127.0.0.1', '2012-02-03 05:05:18'),
(566, '192.168.1.5', '2012-02-03 05:05:27'),
(567, '192.168.1.5', '2012-02-03 07:34:52'),
(568, '192.168.1.45', '2012-02-03 10:40:06'),
(569, '192.168.1.5', '2012-02-03 10:43:01'),
(570, '127.0.0.1', '2012-02-03 11:52:18'),
(571, '192.168.1.5', '2012-02-03 11:52:21'),
(572, '192.168.1.5', '2012-02-03 11:52:21'),
(573, '192.168.1.5', '2012-02-03 11:52:21'),
(574, '192.168.1.5', '2012-02-03 11:52:21'),
(575, '192.168.1.5', '2012-02-03 11:52:21'),
(576, '192.168.1.5', '2012-02-03 11:52:21'),
(577, '192.168.1.5', '2012-02-03 11:52:22'),
(578, '192.168.1.5', '2012-02-03 11:52:22'),
(579, '192.168.1.5', '2012-02-03 11:52:22'),
(580, '192.168.1.5', '2012-02-03 11:52:22'),
(581, '127.0.0.1', '2012-02-03 13:11:56'),
(582, 'fe80::2460:9a21:2984:5590', '2012-03-13 12:23:26'),
(583, '::1', '2012-03-13 13:13:40'),
(584, 'fe80::2460:9a21:2984:5590', '2012-03-13 13:13:40'),
(585, 'fe80::2460:9a21:2984:5590', '2012-03-13 13:13:40'),
(586, 'fe80::2460:9a21:2984:5590', '2012-03-13 13:13:40'),
(587, 'fe80::2460:9a21:2984:5590', '2012-03-13 13:13:40'),
(588, 'fe80::2460:9a21:2984:5590', '2012-03-13 13:13:40'),
(589, 'fe80::2460:9a21:2984:5590', '2012-03-13 13:13:40'),
(590, 'fe80::2460:9a21:2984:5590', '2012-03-13 13:13:40'),
(591, 'fe80::2460:9a21:2984:5590', '2012-03-13 13:13:40'),
(592, 'fe80::2460:9a21:2984:5590', '2012-03-13 13:13:40'),
(593, 'fe80::2460:9a21:2984:5590', '2012-03-13 13:13:40'),
(594, '::1', '2012-03-14 04:52:40'),
(595, '::1', '2012-03-14 05:05:27'),
(596, 'fe80::2460:9a21:2984:5590', '2012-03-14 05:17:31'),
(597, 'fe80::c5a1:8cfd:c519:6c20', '2012-03-14 05:54:22'),
(598, 'fe80::2460:9a21:2984:5590', '2012-03-14 06:14:58'),
(599, '::1', '2012-03-14 12:01:31'),
(600, 'fe80::2460:9a21:2984:5590', '2012-03-14 12:01:32'),
(601, '::1', '2012-03-14 13:22:09'),
(602, 'fe80::c5a1:8cfd:c519:6c20', '2012-03-14 14:08:52'),
(603, 'fe80::30c0:e2e8:9b71:7fbb', '2012-03-14 15:17:38'),
(604, '::1', '2012-03-15 04:59:09'),
(605, 'fe80::2460:9a21:2984:5590', '2012-03-15 04:59:14'),
(606, 'fe80::2460:9a21:2984:5590', '2012-03-15 05:11:32'),
(607, '192.168.1.5', '2012-03-15 06:36:09');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
