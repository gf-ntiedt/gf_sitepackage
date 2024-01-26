#
# Add SQL definition of database tables
#
CREATE TABLE tt_content (
    gf_sitepackage_columnwidth varchar(30) DEFAULT '0' NOT NULL,
    gf_sitepackage_columnwidths varchar(30) DEFAULT '0' NOT NULL,
    gf_sitepackage_breakpoint tinytext,
    gf_sitepackage_gutter_x tinytext,
    gf_sitepackage_gutter_y tinytext,
    gf_sitepackage_type varchar(60) DEFAULT '' NOT NULL,
    gf_sitepackage_orientation_horizontal varchar(60) DEFAULT '' NOT NULL,
    gf_sitepackage_orientation_vertical varchar(60) DEFAULT '' NOT NULL,
    space_inner_before_class varchar(60) DEFAULT '' NOT NULL,
    space_inner_after_class varchar(60) DEFAULT '' NOT NULL,
);