# Complexity Caused By State [![Build Status](https://travis-ci.org/DDD-Hamburg/complexity-caused-by-state.svg?branch=master)](https://travis-ci.org/DDD-Hamburg/complexity-caused-by-state)

Example code for one of the complexities caused by state as discussed in the [DDD Hamburg Meetup Group](https://www.meetup.com/DDD-HH-Domain-driven-Design-Hamburg/events/234678922/)
and based on the ideas from the seminal paper ["Out Of The Tar Pit"](https://github.com/papers-we-love/papers-we-love/blob/master/design/out-of-the-tar-pit.pdf)
by Ben Moseley and Peter Marks.

## Setup

```
# Clone the repo
$ git clone git@github.com:DDD-Hamburg/complexity-caused-by-state.git

# Install composer and project dependencies
$ make bootstrap

## The experiment

Have a look the `examples` folder to get a grasp of the problem caused by state.
We created different Calculators to solve a very simple calculation problem that leads to common errors.

```
$ php tool/evaluate_complexity.php

```
The script will iterate for every Calculator and validate the results.

To be able to fully test every calculator you'll need:
1. Full working environment in Elixir with Phoenix
2. Checkout https://github.com/DDD-Hamburg/complexity-elixir and follow the instructions in the repository to make it work
3. Full working environment in Haskell
4. Checkout https://github.com/DDD-Hamburg/complexity-haskell and follow the instructions in the repository to make it work

```

## General Information

The repository provides a `Makefile` to help you speeding up your development process.

```
$ make help
bootstrap    Install composer
tests        Execute test suite and create code coverage report
update       Update composer packages
```

