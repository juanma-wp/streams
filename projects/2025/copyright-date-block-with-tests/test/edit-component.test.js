import { render, screen } from "@testing-library/react";
import "@testing-library/jest-dom";

const mockEditProps = {
  attributes: {
    fallbackCurrentYear: "2024",
    showStartingYear: false,
    startingYear: "",
  },
  setAttributes: jest.fn(),
  clientId: "test-id",
  className: "wp-block-copyright-date",
};

const originalDate = global.Date;

import Edit from "../src/edit";

describe("Edit component", () => {
  beforeEach(() => {
    mockEditProps.setAttributes.mockClear();
    global.Date = class extends Date {
      getFullYear() {
        return 2024;
      }
    };
  });
  afterEach(() => {
    global.Date = originalDate;
  });

  it("matches snapshot", () => {
    const { container } = render(<Edit {...mockEditProps} />);
    expect(container).toMatchSnapshot();
  });
  it("displays current year by default", () => {
    const { getByText } = render(<Edit {...mockEditProps} />);
    expect(getByText(/© 2024/)).toBeInTheDocument();
  });
  describe("Settings Panel", () => {
    it("renders Inspector Controls", () => {
      const { getByTestId } = render(<Edit {...mockEditProps} />);
      expect(getByTestId("inspector-controls")).toBeInTheDocument();
    });
    it("renders PanelBody with correct title", () => {
      const { getByTestId } = render(<Edit {...mockEditProps} />);
      expect(getByTestId("panel-body")).toBeInTheDocument();
      expect(getByTestId("panel-body")).toHaveAttribute(
        "data-title",
        "Settings"
      );
    });
    it("doesn't render TextControl if showStartingYear is false", () => {
      const { queryByTestId } = render(<Edit {...mockEditProps} />);
      expect(queryByTestId("text-control")).not.toBeInTheDocument();
    });
    it("renders TextControl if showStartingYear is true", () => {
      const mockEditPropsWithStartingYear = {
        ...mockEditProps,
        attributes: {
          ...mockEditProps.attributes,
          showStartingYear: true,
        },
      };
      const { getByTestId } = render(
        <Edit {...mockEditPropsWithStartingYear} />
      );
      expect(getByTestId("text-control")).toBeInTheDocument();
    });
  });
});
