<h2>DC Gradient Slider &ndash; Free Joomla 5/6 Module</h2>
<p>DC Gradient Slider is a free, open-source Joomla 5 and Joomla 6 module that combines a classic fade slider with animated canvas gradients powered by Granim.js.</p>
<p>It was created to solve a simple problem: most Joomla sliders look the same. This module introduces subtle animated backgrounds, smooth fade transitions and a configurable SVG arc to create a modern and distinctive hero section.</p>
<h3>✨ Key Features</h3>
<ul>
<li>
<p>🎞 Slick-based fade slider (smooth UX)</p>
</li>
<li>
<p>🎨 Animated canvas gradient powered by Granim.js</p>
</li>
<li>
<p>🌈 Multiple gradient color sets</p>
</li>
<li>
<p>🖼 Image + heading + description + button support</p>
</li>
<li>
<p>🌙 Configurable SVG arc at the bottom</p>
</li>
<li>
<p>⚙ Full backend configuration (no hardcoded values)</p>
</li>
<li>
<p>🔓 100% open source (GitHub)</p>
</li>
<li>
<p>🚀 Lightweight and performance-oriented</p>
</li>
</ul>
<h3>🧠 Technical Architecture</h3>
<p><strong>Frontend Layer</strong></p>
<ul>
<li>
<p>Built on Slick Slider (stable, predictable, production-tested)</p>
</li>
<li>
<p>Uses <code>fade</code> mode for smoother transitions</p>
</li>
<li>
<p>Gradient initialization synchronized with Slick <code>init</code> event</p>
</li>
<li>
<p>Safe multi-instance support per page</p>
</li>
</ul>
<p><strong>Gradient Engine</strong></p>
<ul>
<li>
<p>Canvas-based gradient rendering via Granim.js</p>
</li>
<li>
<p>Overlay architecture (image stays as CSS background)</p>
</li>
<li>
<p>Uses <code>mix-blend-mode</code> for modern blending effects</p>
</li>
<li>
<p>Supports multiple gradient sets defined in backend</p>
</li>
</ul>
<p><strong>Security</strong></p>
<ul>
<li>
<p>All backend data escaped in PHP</p>
</li>
<li>
<p>Configuration passed via JSON encoding</p>
</li>
<li>
<p>No inline user-generated JavaScript</p>
</li>
<li>
<p>No hidden trackers or telemetry</p>
</li>
<li>
<p>CDN dependencies can be hosted locally</p>
</li>
</ul>
<p><strong>Performance</strong></p>
<ul>
<li>
<p>Minimal footprint</p>
</li>
<li>
<p>Lazy initialization</p>
</li>
<li>
<p>No heavy frameworks (no Vue, no React)</p>
</li>
<li>
<p>Optional jQuery loading</p>
</li>
</ul>
<h3>⚙ Image Handling (Important Note)</h3>
<p>Granim.js does not support <code>background-size: cover</code>.</p>
<p>Current image configuration:</p>
<div>
<div>
<div>
<div>
<div>
<div>
<div>
<div>
<div>
<div>
<div>
<div>opts.image = {<br /> source: imgUrl,<br /> blendingMode: 'overlay',<br /> position: ['center', 'center'],<br /> stretchMode: ['stretch-if-smaller', 'stretch-if-smaller']<br />};</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
<p>To avoid image distortion, it is recommended to prepare images in the same aspect ratio as the slider container.</p>
<h3>📥 Installation</h3>
<ol>
<li>
<p>Download the ZIP package.</p>
</li>
<li>
<p>Go to Joomla Administrator &rarr; System &rarr; Extensions &rarr; Install.</p>
</li>
<li>
<p>Upload the module ZIP file.</p>
</li>
<li>
<p>Create a new instance and assign it to a module position.</p>
</li>
<li>
<p>Configure slides and gradients in backend.</p>
</li>
</ol>
<h3>🎯 Use Cases</h3>
<ul>
<li>
<p>Hero sections for business websites</p>
</li>
<li>
<p>Agency landing pages</p>
</li>
<li>
<p>Software house websites</p>
</li>
<li>
<p>Modern Joomla-based projects</p>
</li>
<li>
<p>Marketing-driven landing pages</p>
</li>
</ul>
<h3>🤝 Contributing</h3>
<p>Pull requests are welcome.<br /> If you find a bug or want to improve the module, feel free to open an issue or submit a PR.</p>

<p>Project Home Page: <a href="https://www.designcart.pl/laboratorium/299-dc-gradient-slider-najbardziej-wyjatkowy-slider-dla-joomla-5-6.html">DC Gradient Slider - najbardziej wyjątkowy slider dla Joomla 5/6</a></p>
