
<p>
    First of all many thanks to the hole TYPO3 community and all supporters of TYPO3. Addional thanks goes to the following extension developers and companies.
</p>
<ul>
    <li>
        <a href="https://www.gedankenfolger.de/" target="_blank">Gedankenfolger GmbH</a>
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
        <li>Carousel</li>
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
<h3>
    Element Address:
</h3>
<p>Used for company related content (logo, address, ...)<br>Accessible via fluid.</p>
<h4>Usage:</h4>
<pre><code>

</code></pre>
<p>Directly if you habe only 1 address</p>
<p>Company name</p>
<pre><code>
{gfaddresses.0.data.tx_mask_name}
</code></pre>
<p>Company zip</p>
<pre><code>
{gfaddresses.0.data.tx_mask_zip}
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