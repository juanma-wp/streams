import domReady from '@wordpress/dom-ready';
import { createRoot } from '@wordpress/element';

// import App from './App';
// import DemoDataViews1 from './demos/DemoDataViews1';
import DemoDataViews2 from './demos/DemoDataViews2';

console.log( 'DemoDataViews2', DemoDataViews2 );
domReady( () => {
	const root = createRoot(
		document.getElementById( 'add-media-from-third-party-service' )
	);
	root.render( <DemoDataViews2 /> );
} );
