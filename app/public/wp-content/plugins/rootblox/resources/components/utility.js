import { __ } from "@wordpress/i18n";

import { memo } from "@wordpress/element";

export const fontWeights = [
  {
    label: __("Thin", "cozy-addons"),
    value: "100",
  },
  {
    label: __("Extra Light", "cozy-addons"),
    value: "200",
  },
  {
    label: __("Light", "cozy-addons"),
    value: "300",
  },
  {
    label: __("Normal", "cozy-addons"),
    value: "400",
  },
  {
    label: __("Medium", "cozy-addons"),
    value: "500",
  },
  {
    label: __("Semi Bold", "cozy-addons"),
    value: "600",
  },
  {
    label: __("Bold", "cozy-addons"),
    value: "700",
  },
  {
    label: __("Extra Bold", "cozy-addons"),
    value: "800",
  },
  {
    label: __("Black", "cozy-addons"),
    value: "900",
  },
];

export const UpsellAttributeWrapper = memo(({ children }) => {
  return (
    <>
      <div className="cthf__upsell-attr-wrapper">
        {children}

        <span className="cthf__pro-label">
          <svg
            width="16"
            height="13"
            viewBox="0 0 16 13"
            xmlns="http://www.w3.org/2000/svg"
          >
            <path d="M13.2 11.2H2.8C2.58 11.2 2.4 11.38 2.4 11.6V12.4C2.4 12.62 2.58 12.8 2.8 12.8H13.2C13.42 12.8 13.6 12.62 13.6 12.4V11.6C13.6 11.38 13.42 11.2 13.2 11.2ZM14.8 3.2C14.1375 3.2 13.6 3.7375 13.6 4.4C13.6 4.5775 13.64 4.7425 13.71 4.895L11.9 5.98C11.515 6.21 11.0175 6.08 10.795 5.69L8.7575 2.125C9.025 1.905 9.2 1.575 9.2 1.2C9.2 0.5375 8.6625 0 8 0C7.3375 0 6.8 0.5375 6.8 1.2C6.8 1.575 6.975 1.905 7.2425 2.125L5.205 5.69C4.9825 6.08 4.4825 6.21 4.1 5.98L2.2925 4.895C2.36 4.745 2.4025 4.5775 2.4025 4.4C2.4025 3.7375 1.865 3.2 1.2025 3.2C0.54 3.2 0 3.7375 0 4.4C0 5.0625 0.5375 5.6 1.2 5.6C1.265 5.6 1.33 5.59 1.3925 5.58L3.2 10.4H12.8L14.6075 5.58C14.67 5.59 14.735 5.6 14.8 5.6C15.4625 5.6 16 5.0625 16 4.4C16 3.7375 15.4625 3.2 14.8 3.2Z" />
          </svg>
        </span>
      </div>
    </>
  );
});

export const AttrWrapper = memo(({ className = "", styles = {}, children }) => {
  return (
    <>
      <div
        className={`cthf__attr-wrapper${
          className.length > 0 ? " " + className : ""
        }`}
        style={styles}
      >
        {children}
      </div>
    </>
  );
});

export function rootbloxRenderTRBL(type, attributes) {
  const sides = ["top", "right", "bottom", "left"];

  // Helper function to generate CSS properties conditionally
  const generateProperty = (prop, side) =>
    attributes[side] ? `${prop}-${side}: ${attributes[side]};` : "";

  // Handle border shorthand and individual borders
  switch (type) {
    case "border":
      // Check if any global border property exists
      if (attributes?.width || attributes?.style || attributes?.color) {
        return `
						${attributes?.width ? `border-width: ${attributes?.width};` : ""}
						${attributes?.style ? `border-style: ${attributes?.style};` : ""}
						${attributes?.color ? `border-color: ${attributes?.color};` : ""}
					`;
      } else if (
        attributes?.top ||
        attributes?.right ||
        attributes?.bottom ||
        attributes?.left
      ) {
        // Handle individual borders for each side
        return sides
          .map((side) =>
            attributes[side]?.width &&
            attributes[side]?.style &&
            attributes[side]?.color
              ? `border-${side}: ${attributes[side].width} ${attributes[side].style} ${attributes[side].color};`
              : ""
          )
          .join("\n");
      }

      return "";

    case "outline":
      if (attributes?.width || attributes?.style || attributes?.color) {
        return `
						${attributes?.width ? `outline-width: ${attributes?.width};` : ""}
						${attributes?.style ? `outline-style: ${attributes?.style};` : ""}
						${attributes?.color ? `outline-color: ${attributes?.color};` : ""}
					`;
      }
      break;

    case "radius":
      // Handle individual border radius for each side
      return `
                ${
                  attributes.top
                    ? `border-top-left-radius: ${attributes.top};`
                    : ""
                }
                ${
                  attributes.right
                    ? `border-top-right-radius: ${attributes.right};`
                    : ""
                }
                ${
                  attributes.bottom
                    ? `border-bottom-right-radius: ${attributes.bottom};`
                    : ""
                }
                ${
                  attributes.left
                    ? `border-bottom-left-radius: ${attributes.left};`
                    : ""
                }
            `;
      break;

    case "padding":
      // Handle padding for each side
      return sides.map((side) => generateProperty("padding", side)).join("\n");

    case "margin":
      // Handle margin for each side
      return sides.map((side) => generateProperty("margin", side)).join("\n");

    default:
      return "";
  }
}

export function getFontOptions(googleFonts) {
  let fontOptions = [{ label: "Default", value: "" }];
  if (typeof googleFonts === "object") {
    // Loop through the array of objects using for...of
    for (let key in googleFonts) {
      fontOptions.push({
        label: googleFonts[key],
        value: key,
      });
    }
  }
  return fontOptions;
}

export const BlockUpsellNotice = memo(() => {
  return (
    <>
      <div class="cthf__block-upsell-notice">
        <h5 class="upsell__title">{__("Need More Options?", "rootblox")}</h5>
        <p>
          {__(
            " PRO gives you full control over styling, layout, and advanced features.",
            "rootblox"
          )}
        </p>
        <a
          class="upsell__btn"
          href={cthfAssets.upsellURL}
          target="_blank"
          rel="nofollow"
        >
          {__("Upgrade to PRO", "rootblox")}
        </a>
      </div>
    </>
  );
});