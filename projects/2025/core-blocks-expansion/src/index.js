import { registerBlockStyle, registerBlockVariation } from "@wordpress/blocks";
import { addFilter } from "@wordpress/hooks";
import { createHigherOrderComponent } from "@wordpress/compose";
import { InspectorControls } from "@wordpress/block-editor";
import { PanelBody } from "@wordpress/components";

registerBlockStyle("core/image", {
  name: "hand-drawn",
  label: "Hand Drawn",
});

registerBlockVariation("core/spacer", {
  name: "themeslug/spacer",
  title: "Theme Name: Spacer",
  keywords: ["space", "spacer", "spacing"],
  attributes: {
    height: "180px",
  },
  isActive: (blockAttributes) =>
    blockAttributes.height && "180px" === blockAttributes.height,
});

function addNamespaceAttribute(settings, name) {
  if (name !== "core/quote") {
    return settings;
  }

  const extraAttributes = {
    namespace: {
      type: "string",
    },
  };

  return {
    ...settings,
    attributes: {
      ...settings.attributes,
      ...extraAttributes,
    },
  };
}

addFilter(
  "blocks.registerBlockType",
  "core-blocks-expansion/core-quote-custom",
  addNamespaceAttribute
);

registerBlockVariation("core/quote", {
  name: "quote-custom",
  description: "Custom Quote Block that does amazing things",
  title: "Custom Quote",
  attributes: {
    namespace: "custom-quote",
  },
  isActive: ["namespace"],
});

const isCustomQuote = (props) => {
  const {
    attributes: { namespace },
  } = props;
  return namespace && namespace === "custom-quote";
};

const withMyPluginControls = createHigherOrderComponent((BlockEdit) => {
  return (props) => {
    if (!isCustomQuote(props)) {
      return <BlockEdit {...props} />;
    }

    console.log(props);

    return (
      <>
        <BlockEdit key="edit" {...props} />
        <InspectorControls>
          <PanelBody>My custom control</PanelBody>
        </InspectorControls>
      </>
    );
  };
}, "withMyPluginControls");

addFilter(
  "editor.BlockEdit",
  "core-blocks-expansion/with-inspector-controls",
  withMyPluginControls
);
