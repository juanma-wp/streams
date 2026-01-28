/**
 * Retrieves the translation of text.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/packages/packages-i18n/
 */
import { __ } from '@wordpress/i18n';

/**
 * React hook that is used to mark the block wrapper element.
 * It provides all the necessary props like the class name.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/packages/packages-block-editor/#useblockprops
 */
import { useBlockProps, InspectorControls } from '@wordpress/block-editor';

/**
 * WordPress components for UI controls
 */
import { PanelBody, RangeControl, SelectControl } from '@wordpress/components';

/**
 * The edit function describes the structure of your block in the context of the
 * editor. This represents what the editor will render when the block is used.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/block-api/block-edit-save/#edit
 *
 * @param {Object}   props               Properties passed to the function.
 * @param {Object}   props.attributes    Available block attributes.
 * @param {Function} props.setAttributes Function that updates individual attributes.
 *
 * @return {Element} Element to render.
 */
export default function Edit( { attributes, setAttributes } ) {
	const blockProps = useBlockProps();
	const { durationInSeconds } = attributes;

	// Helper function to format time
	const formatTime = ( seconds ) => {
		const mins = Math.floor( seconds / 60 );
		const secs = seconds % 60;
		return `${ String( mins ).padStart( 2, '0' ) }:${ String(
			secs
		).padStart( 2, '0' ) }`;
	};

	// Preset duration options
	const presetOptions = [
		{ label: __( 'Custom', 'countdown-timer' ), value: 0 },
		{ label: __( '1 minute', 'countdown-timer' ), value: 60 },
		{ label: __( '2 minutes', 'countdown-timer' ), value: 120 },
		{ label: __( '5 minutes', 'countdown-timer' ), value: 300 },
		{ label: __( '10 minutes', 'countdown-timer' ), value: 600 },
		{ label: __( '15 minutes', 'countdown-timer' ), value: 900 },
	];

	return (
		<>
			<InspectorControls>
				<PanelBody
					title={ __( 'Countdown Settings', 'countdown-timer' ) }
				>
					<SelectControl
						label={ __( 'Duration Preset', 'countdown-timer' ) }
						value={
							presetOptions.find(
								( opt ) => opt.value === durationInSeconds
							)?.value || 0
						}
						options={ presetOptions }
						onChange={ ( value ) => {
							if ( value !== '0' ) {
								setAttributes( {
									durationInSeconds: parseInt( value ),
								} );
							}
						} }
						help={ __(
							'Choose a preset duration or use custom range below',
							'countdown-timer'
						) }
					/>
					<RangeControl
						label={ __(
							'Custom Duration (seconds)',
							'countdown-timer'
						) }
						value={ durationInSeconds }
						onChange={ ( value ) =>
							setAttributes( { durationInSeconds: value } )
						}
						min={ 1 }
						max={ 3600 }
						help={ __(
							'Set countdown duration from 1 second to 1 hour',
							'countdown-timer'
						) }
					/>
				</PanelBody>
			</InspectorControls>
			<div { ...blockProps }>
				<div className="countdown-timer-preview">
					<p>{ __( 'Countdown Timer', 'countdown-timer' ) }</p>
					<p className="countdown-display">
						{ formatTime( durationInSeconds ) }
					</p>
					<p className="countdown-info">
						{ __( 'Duration:', 'countdown-timer' ) }{ ' ' }
						{ durationInSeconds }{ ' ' }
						{ __( 'seconds', 'countdown-timer' ) }
					</p>
				</div>
			</div>
		</>
	);
}
