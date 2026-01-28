import {
  registerBlockType,
  unregisterBlockType,
  createBlock,
} from "@wordpress/blocks";

import metadataBlock from "../src/block.json";

describe("Block Registration", () => {
  beforeEach(() => {
    registerBlockType(metadataBlock.name, metadataBlock);
  });
  afterEach(() => {
    unregisterBlockType(metadataBlock.name);
  });
  it("should register the block", () => {
    const block = createBlock(metadataBlock.name);
    expect(block.name).toBe(metadataBlock.name);
    expect(block.attributes.fallbackCurrentYear).toBeUndefined();
    expect(block.attributes.showStartingYear).toBeUndefined();
    expect(block.attributes.startingYear).toBeUndefined();
  });
  it("should handle all valid attributes", () => {
    const attributes = {
      fallbackCurrentYear: "2024",
      showStartingYear: true,
      startingYear: "2020",
    };
    const block = createBlock(metadataBlock.name, attributes);
    expect(block.attributes.fallbackCurrentYear).toBe(
      attributes.fallbackCurrentYear
    );
    expect(block.attributes.showStartingYear).toBe(attributes.showStartingYear);
    expect(block.attributes.startingYear).toBe(attributes.startingYear);
  });
  it("should have correct block support configuration", () => {
    const { supports } = metadataBlock;
    expect(supports.color.background).toBe(false);
    expect(supports.color.text).toBe(true);
    expect(supports.html).toBe(false);
    expect(supports.typography.fontSize).toBe(true);
  });
});
