<h1>TYPO3 Extension Gedankenfolger Sitepackage (gf_sitepackage)</h1>
<p>
    First of all many thanks to the hole TYPO3 community and all supporters of TYPO3.<br>
    Addional thanks goes to the following extension developers and companies.
</p>
<ul>
    <li>
        <a href="https://www.gedankenfolger.de/" target="_blank">Gedankenfolger GmbH</a>
    </li>
    <li>
        <a href="https://extensions.typo3.org/extension/mask" target="_blank">WEBprofil - Gernot Ploiner e.U.</a>
    </li>
    <li>
        <a href="https://extensions.typo3.org/extension/save" target="_blank">Armin Vieweg</a>
    </li>
    <li>
        <a href="https://extensions.typo3.org/extension/content_defender" target="_blank">Nicole Cordes – biz-design</a>
    </li>
    <li>
        <a href="https://extensions.typo3.org/extension/vhs" target="_blank">FluidTYPO3 Team</a>
    </li>
    <li>
        <a href="https://extensions.typo3.org/extension/container" target="_blank">b13 GmbH</a>
    </li>
    <li>
        <a href="https://extensions.typo3.org/extension/ws_scss" target="_blank">Sven Wappler – WapplerSystems</a>
    </li>
    <li>
        <a href="https://getbootstrap.com/" target="_blank">Bootstrap</a>
    </li>
</ul>

<h3>
    Contents of this file
</h3>
<ol>
    <li>
        <a href="#dependencies">Dependencies</a>
    </li>
    <li>
        <a href="#includedelements">Included Elements</a>
    </li>
    <li>
        <a href="#marginsandpaddings">Margins and paddings</a>
    </li>
    <li>
        <a href="#element_address">Element: Address</a>
    </li>
    <li>
        <a href="#license">License</a>
    </li>
</ol>

<h3 id="dependencies">
    Dependencies
</h3>
<ul>
    <li>t3/save</li>
    <li>ichhabrecht/content-defender</li>
    <li>fluidtypo3/vhs</li>
    <li>mask/mask</li>
    <li>b13/container</li>
    <li>wapplersystems/ws-scss</li>
</ul>

<h3 id="includedelements">
    Included Elements
</h3>
<ul>
    <li>Header</li>
    <ul>
        <li>Language Navigation</li>
        <li>Logo</li>
        <li>Claim</li>
        <li>Multilevel Navigation</li>
    </ul>
    <li>Content</li>
    <ul>
        <li>Image/Text</li>
        <ul>
            <li>Header</li>
            <li>Header-Layout (h1,h2,...)</li>
            <li>RTE-Text</li>
            <li>Link</li>
            <li>Assets: Images and videos</li>
            <li>Position</li>
            <li>Predefined css color classes for Button, Text, Background</li>
            <li>Grid width for Image and Text</li>
        </ul>
        <li>Carousel</li>
        <ul>
            <li>Special versions for preface and normal content</li>
            <li>Show/hide indicators, controls and caption</li>
            <li>Widemode</li>
        </ul>
        <li>Addresslist (e.g. locations)</li>
        <li>Powermail</li>
        <li>Container</li>
        <ul>
            <li>Left and right column (2-Columns)</li>
            <li>Multiple equal width columns (Columnizer Contents)</li>
        </ul>
    </ul>
    <li>Footer</li>
    <ul>
        <li>Logo</li>
        <li>Address Block</li>
        <ul>
            <li>Company</li>
            <li>Street and Number</li>
            <li>Zip and City</li>
            <li>Phone</li>
            <li>Fax</li>
        </ul>
        <li>Navigation</li>
        <ul>
            <li>Imprint</li>
            <li>Privacy</li>
        </ul>
    </ul>
</ul>

<h3 id="marginsandpaddings">
    Margins and paddings:
</h3>
<p>Every content element include the possibility to define margins and paddings. <br>
This could be done at the top and bottom. </p>

<h3 id="element_address">
    Element Address:
</h3>
<p>Used for company related content (logo, address, ...)<br>Accessible via fluid.</p>
<h4>Available fields:</h4>
<table>
    <tr>
        <td>tx_mask_logo</td>
    </tr>
    <tr>
        <td>tx_mask_name</td>
    </tr>
    <tr>
        <td>tx_mask_claim</td>
    </tr>
    <tr>
        <td>tx_mask_phone</td>
    </tr>
    <tr>
        <td>tx_mask_fax</td>
    </tr>
    <tr>
        <td>tx_mask_street</td>
    </tr>
    <tr>
        <td>tx_mask_street_nr</td>
    </tr>
    <tr>
        <td>tx_mask_zip</td>
    </tr>
    <tr>
        <td>tx_mask_city</td>
    </tr>
    <tr>
        <td>tx_mask_country</td>
    </tr>
    <tr>
        <td>tx_mask_main</td>
    </tr>
    <tr>
        <td>tx_mask_email</td>
    </tr>
</table>
<h4>Usage with multiple addresses:</h4>
<pre><code>
&lt;f:for each="{gfaddresses}" as="address">
    {address.data.tx_mask_name}
&lt;/f:for>
</code></pre>
<p>If you use tx_mask_phone or tx_mask_fax there is a neat <a href="viewhelper">small viewhelper</a> which perform the work for you.

<h3 id="viewhelper">
    Viewhelper
</h3>
<h4>gf:link.urlscheme()</h4>
<p> Converts<br>
    +49 (0) 7777 789789 to </p>
<pre><code>
&lt;a href="tel:+497777789789"&gt;+49 (0) 7777 789789&lt;/a&gt;
</code></pre>
<h4>Usage:</h4>
<pre><code>
&lt;gf:link.urlscheme
    number="+49 (0) 7777 789789"
    class="" />
</code></pre>
<pre><code>
&lt;gf:link.urlscheme
    number="+49 (0) 7777 789788"
    scheme="fax:"
    class="" />
</code></pre>
<h4>Hint:</h4>
<p>If you got an error missing namespace include:</p>
<pre><code>
{namespace gf=Gedankenfolger\GfSitepackage\ViewHelpers}
</code></pre>

<h3 id="license">
    License
</h3>
<p>GNU GENERAL PUBLIC LICENSE Version 2</p>