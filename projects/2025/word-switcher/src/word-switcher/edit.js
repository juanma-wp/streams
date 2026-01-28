import { __ } from "@wordpress/i18n";
import { useBlockProps, RichText } from "@wordpress/block-editor";
import "./editor.scss";
import { registerWordSwitcherFormatType } from "./registerFormatType";

registerWordSwitcherFormatType();
export default function Edit({ attributes, setAttributes }) {
	const { content } = attributes;
	const handleChange = (newContent) => {
		setAttributes({ content: newContent });
	};
	return (
		<div {...useBlockProps()}>
			<RichText
				tagName="p"
				value={content}
				onChange={handleChange}
				placeholder={__("Write something", "word-switcher")}
			/>
		</div>
	);
}
