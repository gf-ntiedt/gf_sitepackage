<h1>TYPO3 Extension Gedankenfolger Sitepackage (gf_sitepackage)</h1>
<p>
    First of all many thanks to the hole TYPO3 community, all supporters of TYPO3 and especially to the TYPO3-Team + Gedankenfolger GmbH.<br>
    Addional thanks goes to the following extension developers and companies.
</p>
<ul>
    <li>
        <a href="https://www.gedankenfolger.de/" target="_blank">Gedankenfolger GmbH</a>
    </li>
    <li>
        <a href="https://typo3.org/" target="_blank">TYPO3</a>
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
    <li>
        <a href="https://swiperjs.com/" target="_blank">Swiper</a>
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
        <a href="#todos">Todos</a>
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
        <li>Slider: Assets</li>
        <ul>
            <li>Special versions for preface and normal content</li>
            <li>Settings</li>
            <ul>
                <li>speed</li>
                <li>slidesPerView</li>
                <li>Autoplay delay</li>
                <li>Autoplay pauseOnMouseEnter</li>
                <li>loop</li>
                <li>initialSlide</li>
            </ul>
            <li>Layout</li>
            <ul>
                <li>Pagination</li>
                <li>Navigation</li>
                <li>Scrollbar</li>
                <li>Lowmode</li>
                <li>Widemode</li>
                <li>spaceBetween</li>
            </ul>
        </ul>
        <li>Slider: Contents</li>
        <li>Addresslist (e.g. locations)</li>
        <li>Google Maps</li>
        <ul>
            <li>Embed and static version</li>
            <li>Zoom level</li>
            <li>Map type</li>
            <li>Custom marker icon</li>
        </ul>
        <li>Powermail</li>
        <li>Container</li>
        <ul>
            <li>Left and right column (2-Columns)</li>
            <li>Columnizer Contents</li>
            <ul>
                <li>Multiple equal width columns</li>
                <li>Gutter width x-axis</li>
            </ul>
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

<h3 id="swiper">
    Swiper (Version 11.0.5):
</h3>
<p>For configuration please have a look at "<a href="https://swiperjs.com/get-started" target="_blank">Getting Started With Swiper</a>" and the following files:</p>
<ul>
    <li>
        EXT:gf_sitepackage/Resources/Private/Partials/ContentElements/Columnizercontents/Swiper.html
    </li>
    <li>
        EXT:gf_sitepackage/Resources/Public/JavaScript/Dist/Swiper/*
    </li>
    <li>
        EXT:gf_sitepackage/Resources/Public/Css/Swiper/*
    </li>
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
    Viewhelper:
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

<h3 id="todos">
    Todos:
</h3>
    <ul>
        <li>...</li>
    </ul>

<h3 id="license">
    License:
</h3>
<p>GNU GENERAL PUBLIC LICENSE Version 2</p>