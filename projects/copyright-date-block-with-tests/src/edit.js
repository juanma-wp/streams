import { __ } from "@wordpress/i18n";
import { InspectorControls, useBlockProps } from "@wordpress/block-editor";
import { PanelBody, TextControl, ToggleControl } from "@wordpress/components";
import { useEffect } from "react";

export default function Edit(props) {
  const { attributes, setAttributes } = props;
  const { fallbackCurrentYear, showStartingYear, startingYear } = attributes;

  const currentYear = new Date().getFullYear().toString();

  useEffect(() => {
    if (currentYear !== fallbackCurrentYear) {
      setAttributes({ fallbackCurrentYear: currentYear });
    }
  }, [currentYear, fallbackCurrentYear, setAttributes]);

  let displayDate;

  if (showStartingYear && startingYear) {
    displayDate = startingYear + "–" + currentYear;
  } else {
    displayDate = currentYear;
  }

  return (
    <>
      <InspectorControls>
        <PanelBody title={__("Settings", "copyright-date-block-with-tests")}>
          <ToggleControl
            checked={showStartingYear}
            label={__("Show starting year", "copyright-date-block-with-tests")}
            onChange={() =>
              setAttributes({
                showStartingYear: !showStartingYear,
              })
            }
          />
          {showStartingYear && (
            <TextControl
              label={__("Starting year", "copyright-date-block-with-tests")}
              value={startingYear}
              onChange={(value) => setAttributes({ startingYear: value })}
            />
          )}
        </PanelBody>
      </InspectorControls>
      <p {...useBlockProps()}>© {displayDate}</p>
    </>
  );
}
