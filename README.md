
<p>
    First of all many thanks to the hole TYPO3 community and all supporters of TYPO3. Addional thanks goes to the following extension developers and companies.
</p>
<ul>
    <li>
        <a href="https://www.gedankenfolger.de/" target="_blank">Gedankenfolger GmbH</a>
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
</ol>
<h3 id="dependencies">
    Dependencies
</h3>
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
<code>
    company name {gfaddressesmain.0.data.tx_mask_name}
</code><br>
<code>
    company zip {gfaddressesmain.0.data.tx_mask_zip}
</code>
<p>If you use tx_mask_phone or tx_mask_fax there is a neat small viewhelper which perform the work for you.<br>
    This means it converts<br>
    +49 (0) 7152 42041 to &lt;a href="tel:+49715242041"&gt;+49 (0) 7152 42041&lt;/a&gt;</p>
<h4>Usage:</h4>
<code>
    &lt;gf:link.urlscheme
        number="{gfaddressesmain.0.data.tx_mask_phone}"
        class="" />
</code><br>
<code>
    &lt;gf:link.urlscheme
        number="{gfaddressesmain.0.data.tx_mask_fax}"
        scheme="fax:"
        class="" />
</code>
<h4>Hint:</h4>
<p>If you got an error missing namespace include:</p>
<code>
    {namespace gf=Gedankenfolger\GfSitepackage\ViewHelpers}
</code>