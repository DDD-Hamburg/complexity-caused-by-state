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
```

## General Information

The repository provides a `Makefile` to help you speeding up your development process.

```
$ make help
bootstrap    Install composer
tests        Execute test suite and create code coverage report
update       Update composer packages
```

## Examples

Have a look the `examples` folder to get a grasp of the problem caused by state.

```
$ php examples/complexity-caused-by-state.php
```
