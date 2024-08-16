import { registerBlockType } from "@wordpress/blocks";
import { useBlockProps } from "@wordpress/block-editor";
import metadata from "./block.json";

import "./editor.css";
import "./style.css";

const Edit = () => <p {...useBlockProps()}>Hello World - Block Editor</p>;

registerBlockType(metadata.name, {
  edit: Edit,
});
