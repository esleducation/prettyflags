prettyflags [1.0.x]
===========

Try to make ugly flags a little bit nicer for your eyes...


# How to add a new flag

- get a .svg of the country flag.
- edit the svg to be similar (format-size) as one of the svg in the `ugly` folder.
- create a apache config file in the `/data/web/.conf` for the flags project.
- Run the `index.php` via the url of the apache config
- Fill the form to generate your requested flag image files.
- Commit you work and **create a new tag**

# How to update the agency project

For the agency (template project) you also need to:
- add the adequate css
	- open `05_objects/_flag_icons.scss`
	- add a `@include flag-icon(ad);` line
- update `bower.json` with the new tag
- then you need to run
	- `bower update`
	- `grunt copy:flags`
