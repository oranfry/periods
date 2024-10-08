# Periods

A framework for chunking the calendar

## Introduction

A **Period** is a system of chunking all dates on the calendar. **Month** and **Week** are examples of periods, because they are ways to chunk the calendar with no overlaps and no gaps in between.

The purpose of this framework is to allow one to implement and work easily with periods, including custom-designed ones.

Examples of custom periods could be:

 - The Week that starts on Tuesday and goes through to the following Monday
 - The Month that starts on the second Monday of the normal calendar month
 - The Financial year starting on April 1 every year
 - Japanese eras
 - Pre- and post-birth Jeff Goldblum's birth

As you can guess from the last few examples, there doesn't need to be any mathematical uniformity or predictability to the periods. Periods are implemented as PHP functions, so the chunks can be determined in as mathmatical or as piecemeal a fashion as desired.

## Terminology

**All dates** means all possible, valid dates. 'Valid dates' according to this framework means all dates accepted by PHP's `strtotime()` function in the format 'YYYY-MM-DD' (e.g., '2023-08-01'), that are also valid according to PHP's `checkdate()`. There are about 3.65M valid dates.

This means dates back further than '0000-00-00' or forward further than '9999-12-31' are not accepted, and the implementor does not need to identify what chunk they fall into.

The term **Period** refers to a system of chunking (such as "Week").

The term **chunk** to refer to a particular chunk under such a system (such as "Week 47 of 2024").

## How to Implement

To implement a custom Period (a.k.a., a custom system), you only need to be able to produce the start and end dates of the chunk which contains any given date.

For example, suppose you wish to implement the Period "Weeks starting on Tuesday". You would implement the following methods which take an arbitrary valid date, and compute and return as specified:
 - `_start($date)`: returns the last (i.e., latest in time) Tuesday that comes on or before the given date
 - `_end($date)`: return the first (i.e., earliest in time) Monday that comes on or after the given date

Note that start and end dates are inclusive, so if a period starts and ends on the same day, it is 1 day in length.

Some constraints:

 - Only the first chunk on the timeline can lack a start date
 - Only the last chunk on the timeline can lack an end date
 - Chunks with a start date always start at the beginning of a day
 - Chunks with an end date always end at the end of a day
 - All chunks must be at least one day (i.e., the end date cannot be before the start date)
 - Each and every date must be contained within exactly one chunk; there are no gaps between chunk, and no overlaps

The framework does not attempt to verify that your implementation is conforming to these constraints, so the disclaimer is made that you will get undefined behaviour id you do not adhere to these constraints. Please put some unit tests in place to validate any Periods you implement. In the future I will add a testing framework for periods under development.

The framework takes care of making sure only valid dates are passed to your `_start()` and `_end()` methods.

## Optional Implementation

Optionally, you can also implement chunk IDs and labels by implementing the method  `_chunkId($from, $to)`, `_chunkLabel($from, $to)`. Here are some example labels based on the same week under different Period systems:

 - 25 Nov ~ 1 Dec, 2024
 - Week 47, 2024
 - Week 3749 of Jeff Goldblum's life

The corresponding options for IDs might be something like these:
 - 2024-11-25~2024-12-01
 - 2024w47
 - w3749

If you are using multiple period systems in one application and want to make sure the chunk IDs don't conflict with each other, prepend them with something unique to the period before saving:

 - W2024-11-25~2024-12-01
 - W2024w47
 - JGw3749

 The framework makes sure only the start and end dates of a real chunk are passed to your `_chunkId()` and `_chunkLabel()` methods.

## How to use

Please see the examples below.

## Examples

For an example of how to use periods, please see `example/*`.
