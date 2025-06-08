import { __ } from "@wordpress/i18n";
import { useBlockProps, InspectorControls } from "@wordpress/block-editor";
import { PanelBody, SelectControl } from "@wordpress/components";
import ServerSideRender from "@wordpress/server-side-render";
import { useEntityRecords } from "@wordpress/core-data";

export default function Edit({ attributes, setAttributes }) {
	const { records: categories } = useEntityRecords("taxonomy", "category");
	const categoriesOptions = categories
		? [
				{ label: "Select a Category", value: "", disabled: true },
				...categories.map(({ name, id }) => ({
					label: name,
					value: id,
				})),
		  ]
		: [];

	return (
		<>
			<InspectorControls>
				<PanelBody>
					<SelectControl
						__next40pxDefaultSize
						__nextHasNoMarginBottom
						label="Label"
						onChange={(selectedCategory) => {
							setAttributes({ categoryId: parseInt(selectedCategory, 10) });
						}}
						options={categoriesOptions}
					/>
				</PanelBody>
			</InspectorControls>
			<div {...useBlockProps()}>
				<ServerSideRender
					block="create-block/block-category-posts"
					attributes={attributes}
				/>
			</div>
		</>
	);
}
