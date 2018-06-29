## About Inkblot ACE

Inkblot ACE is a Wordpress theme that was derived from the Inkblot theme. 

Inkblot ACE modifies the theme so that it can be used effectively as an archive for comics sent by email. If you share a link to a post, the link also gives access to the archive upto that post. With the link, you will never be able to read past that post, unless you get a new link from the creator.


Inkblot is an elegant, [fully responsive](https://en.wikipedia.org/wiki/Responsive_web_design), [highly customizable](https://codex.wordpress.org/Appearance_Customize_Screen) [Webcomic](https://github.com/mgsisk/webcomic)-ready [WordPress](https://wordpress.org) theme, named in honor of Rorschach from the Watchmen graphic novel.

## Installation

You can install Inkblot from the **Themes > Add New** page in the administrative dashboard. Just do a search for `inkblot` and the first result should be the one you're looking for.

### Manual Installation

1. Download and extract Inkblot from the [WordPress.org theme directory](https://wordpress.org/themes/inkblot) (for the most recent stable release) or the [master GitHub repository](https://github.com/mgsisk/inkblot) (for the most up-to-date release).
2. Upload the `inkblot` directory to your `wp-content/themes` directory.
3. Activate Inkblot through the **Appearance > Themes** page in the administrative dashboard.


## How Inkblot ACE differs from Inkblot

Additional modifications in this fork of Inkblot were made by Ayal Pinkus with help from Jason Brubaker. This forked version is designed to act as an archive for use with a comics mailing list: it shows posts from oldest to newest for a better reading experience, and a 'lastpost' query parameter is required, being the name (slug) of the last post to be shown. 

Create story posts under the 'story' category, and under the 'afterword' category for a call to action. Posts filed under the category 'afterword' will be appended below the list of posts. You could add a call to action in that post, to join a mailing list for example. 

You can create posts filed under the category 'welcome' and they will show when someone lands on your website without having a link to a specific post. You can use this post to redirect visitors to your Patreon or mailing list, where they can get links to your posts after they subscribe to your mailing list or become a Patron.

The main index page shows all posts filed under the category 'story'. You can only see the posts upto and including the post you had the link to. You basically have an archive of posts up to that point. If there are newer posts, you can not see them unless you have a link to them.

You can, of you want, also add these posts to categories that are sub-categories of the 'story' category. These sub-categories could for example represent chapters. Below the main list of posts is a list with these sub-categories. This would allow the visitor to jump to one of these chapters.

<p>You can also file a post under the category 'afterword' to specify a call to action to be placed below lists of posts.<p>

## How To Share Posts

Visitors can not see posts by default. If you go to the admin area, and click on the permalink of a post, you can share the url in the url bar of the browser, and people will be able to see all posts upto that post.

This theme is meant to be used as an archive for a newsletter, allowing people to see all posts upto a specified point.

## How It Works

You will notice that the url ends with ?lastpost=(post-slug) . post-slug is the slug of the post you are sharing, and is effectively used as the password that allows people access to the archive of posts upto and including that post.

<u><b>So it is important that you use slugs for your posts that people can not guess easily!</b></u>

You can for example use the title of a post to create the slug. Numbers or dates for example are not well-suited as slugs, because they can be easily guessed, allowing people access to your posts. The slug should be descriptive so people reading the url know what to expect, but at the same time you should also consider the slug of each post to be a password allowing access to your content. So make it long and surprising and unguessable.




## Frequently Asked Questions

### Where can I get help with Inkblot?

- [Issue Tracker](https://github.com/mgsisk/inkblot/issues)
- [Support Forum](https://wordpress.org/support/theme/inkblot)
- [Email Support](mailto:help@mgsisk.com)

---

Inkblot © 2008 - 2015 Michael Sisk (me@mgsisk.com)

Inkblot ACE © 2018 Ayal Pinkus (https://www.ayalpinkus.nl)


This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program.  If not, see https://www.gnu.org/licenses.
