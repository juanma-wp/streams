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
  it("renders Inspector Controls", () => {
    const { getByTestId } = render(<Edit {...mockEditProps} />);
    expect(getByTestId("inspector-controls")).toBeInTheDocument();
  });
});
