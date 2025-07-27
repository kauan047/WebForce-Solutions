(($) => {
  window["cthfBusinessHours"] = (e) => {
    const element = $(`#${e}`);

    const attributes = window[e];

    const { DateTime } = luxon;

    function checkDefaultBusinessStatus() {
      // Get local timezone from user's browser
      const localTimezone = DateTime.local().zoneName;

      const systemTimezone = attributes.systemTimezone.timezone;
      const systemLocale = attributes.systemLocale;

      // Current time in correct timezone
      const now = DateTime.now().setZone(systemTimezone);

      // Get today's weekday name (e.g., 'monday', 'tuesday')
      const dayName = now
        .setLocale(systemLocale)
        .toFormat("cccc")
        .toLowerCase();

      // Find today's config
      const todayConfig = attributes.weekdays.find(
        (day) => day.key === dayName
      );

      // If closed today
      if (!todayConfig || !todayConfig.opened) {
        return updateBusinessStatus(attributes.notification.close);
      }

      // Time diff for "nearing" (e.g., 30 minutes before open/close)
      const timeDiffMs =
        (parseInt(attributes.notification.timeDiff.hours, 10) * 60 +
          parseInt(attributes.notification.timeDiff.minutes, 10)) *
        60 *
        1000;

      // Build open and close times in same timezone
      const baseDate = now.startOf("day"); // Start of today in systemTimezone

      const openTime = baseDate.set({
        hour: parseInt(todayConfig.openTime.hours, 10),
        minute: parseInt(todayConfig.openTime.minutes, 10),
      });

      const closeTime = baseDate.set({
        hour: parseInt(todayConfig.closeTime.hours, 10),
        minute: parseInt(todayConfig.closeTime.minutes, 10),
      });

      const openMs = openTime.toMillis();
      const closeMs = closeTime.toMillis();

      const nearingOpenStart = openMs - timeDiffMs;
      const nearingCloseStart = closeMs - timeDiffMs;

      // Compare times and update status
      const nowMs = now.toMillis();

      // Always Open (24 hours)
      if (todayConfig.alwaysOpen) {
        updateBusinessStatus(attributes.notification.open);
      }

      // Opening Soon
      else if (nowMs >= nearingOpenStart && nowMs < openMs) {
        updateBusinessStatus(
          attributes.notification.nearingOpen,
          openMs - nowMs
        );
      }

      // Closing Soon
      else if (nowMs >= nearingCloseStart && nowMs < closeMs) {
        updateBusinessStatus(
          attributes.notification.nearingClose,
          closeMs - nowMs
        );
      }

      // Open
      else if (nowMs >= openMs && nowMs < closeMs) {
        updateBusinessStatus(attributes.notification.open);
      }

      // Closed
      else {
        updateBusinessStatus(attributes.notification.close);
      }

      // Compare them
      if (localTimezone !== systemTimezone) {
        getSystemTime(systemTimezone, systemLocale);
      } else {
        element.find(".timezone__warning").remove();
      }
    }

    function updateBusinessStatus(status, remainingMs = null) {
      element.find(".notification .message").text(status); // Example DOM update

      if (remainingMs !== null) {
        const totalSeconds = Math.floor(remainingMs / 1000);
        const hours = Math.floor(totalSeconds / 3600);
        const minutes = Math.floor((totalSeconds % 3600) / 60);
        const seconds = totalSeconds % 60;

        const formattedTime = `${String(hours).padStart(2, "0")}${
          attributes.notification.timerLabel.h
        } : ${String(minutes).padStart(2, "0")}${
          attributes.notification.timerLabel.m
        } : ${String(seconds).padStart(2, "0")}${
          attributes.notification.timerLabel.s
        }`;
        element.find(".timer").text(formattedTime);
      } else {
        element.find(".timer").text("");
      }
    }

    function checkGroupBusinessStatus() {
      const startOfWeek = attributes.scheduling.startingDay;

      const orderedWeekdays = [
        "sunday",
        "monday",
        "tuesday",
        "wednesday",
        "thursday",
        "friday",
        "saturday",
      ];

      // Rotate weekdays array so it starts from startOfWeek
      const startIndex = orderedWeekdays.indexOf(startOfWeek.toLowerCase());
      const normalizedWeekdays = [
        ...orderedWeekdays.slice(startIndex),
        ...orderedWeekdays.slice(0, startIndex),
      ];

      // Then use index in normalizedWeekdays for all comparisons
      function getNormalizedDayIndex(dayName) {
        return normalizedWeekdays.indexOf(dayName.toLowerCase());
      }

      // Get local timezone from user's browser
      const localTimezone = DateTime.local().zoneName;

      const systemTimezone = attributes.systemTimezone.timezone;
      const systemLocale = attributes.systemLocale;

      // Current time in correct timezone
      const now = DateTime.now().setZone(systemTimezone);

      // Get today's weekday name (e.g., 'monday', 'tuesday')
      const todayName = now
        .setLocale(systemLocale)
        .toFormat("cccc")
        .toLowerCase();

      const todayIndex = getNormalizedDayIndex(todayName);

      const todayGroup =
        attributes.groupedWeekdays.find((group) => {
          const startIndex = getNormalizedDayIndex(group.start);
          const endIndex = getNormalizedDayIndex(group.end);

          if (startIndex <= endIndex) {
            return todayIndex >= startIndex && todayIndex <= endIndex;
          } else {
            // Handle wraparound (e.g., friday to monday)
            return todayIndex >= startIndex || todayIndex <= endIndex;
          }
        }) || null;

      if (todayGroup === null) {
        return updateBusinessStatus(attributes.notification.close);
      }

      // Time diff for "nearing" (e.g., 30 minutes before open/close)
      const timeDiffMs =
        (parseInt(attributes.notification.timeDiff.hours, 10) * 60 +
          parseInt(attributes.notification.timeDiff.minutes, 10)) *
        60 *
        1000;

      // Build open and close times in same timezone
      const baseDate = now.startOf("day"); // Start of today in systemTimezone

      const openTime = baseDate.set({
        hour: parseInt(todayGroup.openTime.hours, 10),
        minute: parseInt(todayGroup.openTime.minutes, 10),
      });

      const closeTime = baseDate.set({
        hour: parseInt(todayGroup.closeTime.hours, 10),
        minute: parseInt(todayGroup.closeTime.minutes, 10),
      });

      const openMs = openTime.toMillis();
      const closeMs = closeTime.toMillis();

      const nearingOpenStart = openMs - timeDiffMs;
      const nearingCloseStart = closeMs - timeDiffMs;

      // Compare times and update status
      const nowMs = now.toMillis();

      // Always Open (24 hours)
      if (todayGroup.alwaysOpen) {
        updateBusinessStatus(attributes.notification.open);
      }

      // Opening Soon
      else if (nowMs >= nearingOpenStart && nowMs < openMs) {
        updateBusinessStatus(
          attributes.notification.nearingOpen,
          openMs - nowMs
        );
      }

      // Closing Soon
      else if (nowMs >= nearingCloseStart && nowMs < closeMs) {
        updateBusinessStatus(
          attributes.notification.nearingClose,
          closeMs - nowMs
        );
      }

      // Open
      else if (nowMs >= openMs && nowMs < closeMs) {
        updateBusinessStatus(attributes.notification.open);
      }

      // Closed
      else {
        updateBusinessStatus(attributes.notification.close);
      }

      // Compare them
      if (localTimezone !== systemTimezone) {
        getSystemTime(systemTimezone, systemLocale);
      } else {
        element.find(".timezone__warning").remove();
      }
    }

    // Run every second
    if (attributes.scheduling.type === "default") {
      checkDefaultBusinessStatus();
      setInterval(checkDefaultBusinessStatus, 1000);
    } else if (attributes.scheduling.type === "group") {
      checkGroupBusinessStatus();
      setInterval(checkGroupBusinessStatus, 1000);
    }

    function getSystemTime(timezone, locale) {
      const format = attributes.timeFormat ? "hh:mm:ss a" : "HH:mm:ss";

      const now = DateTime.now().setZone(timezone).setLocale(locale);

      element
        .find(".timezone__warning .time__wrap .label")
        .text(`Current Time in ${timezone}:`);
      element
        .find(".timezone__warning .time__wrap .time")
        .text(now.toFormat(format));
    }
  };
})(jQuery);
