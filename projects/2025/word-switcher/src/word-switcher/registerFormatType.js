import { toggleFormat, registerFormatType } from "@wordpress/rich-text";
import { RichTextToolbarButton } from "@wordpress/block-editor";
import metadata from "./block.json";

const WORD_SWITCHER_FORMAT_TYPE = metadata.name;

export const registerWordSwitcherFormatType = () => {
	registerFormatType(WORD_SWITCHER_FORMAT_TYPE, {
		title: "Word Switcher",
		tagName: "span",
		className: "word-switcher",
		edit: ({ isActive, onChange, value }) => {
			console.log("Edit Word Switcher format type");
			return (
				<RichTextToolbarButton
					icon="update"
					title="Mark as Word Switcher Area"
					onClick={() => {
						onChange(
							toggleFormat(value, {
								type: WORD_SWITCHER_FORMAT_TYPE,
							}),
						);
					}}
					isActive={isActive}
				/>
			);
		},
	});
};
